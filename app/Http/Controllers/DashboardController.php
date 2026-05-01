<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Hospedaje;
use App\Models\Viaje;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function clientDashboard()
    {
        $user = Auth::user();
        
        // Datos para gráficas
        $viajesPorMes = Viaje::where('user_id', $user->id)
            ->selectRaw('MONTH(fecha_inicio) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->get();
            
        $gastosPorMes = Viaje::where('user_id', $user->id)
            ->selectRaw('MONTH(fecha_inicio) as mes, SUM(precio_total) as total')
            ->groupBy('mes')
            ->get();
            
        $proximosViajes = Viaje::where('user_id', $user->id)
            ->where('fecha_inicio', '>=', now())
            ->with(['destino', 'hospedaje'])
            ->orderBy('fecha_inicio')
            ->limit(5)
            ->get();
            
        $destinosRecomendados = Destino::inRandomOrder()->limit(6)->get();
        
        return view('dashboard.cliente', compact(
            'viajesPorMes', 
            'gastosPorMes', 
            'proximosViajes',
            'destinosRecomendados'
        ));
    }

    public function adminDashboard()
    {
        // Datos para gráficas
        $totalUsuarios = \App\Models\User::count();
        $totalViajes = Viaje::count();
        $totalDestinos = Destino::count();
        $totalHospedajes = Hospedaje::count();
        
        $viajesPorDestino = Viaje::selectRaw('destinos.nombre, COUNT(*) as total')
            ->join('destinos', 'viajes.destino_id', '=', 'destinos.id')
            ->groupBy('destinos.nombre')
            ->limit(6)
            ->get();
            
        $ingresosPorMes = Viaje::selectRaw('MONTH(fecha_inicio) as mes, SUM(precio_total) as total')
            ->whereYear('fecha_inicio', date('Y'))
            ->groupBy('mes')
            ->get();
            
        $viajesRecientes = Viaje::with(['user', 'destino'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        return view('dashboard.admin', compact(
            'totalUsuarios',
            'totalViajes', 
            'totalDestinos',
            'totalHospedajes',
            'viajesPorDestino',
            'ingresosPorMes',
            'viajesRecientes'
        ));
    }
}