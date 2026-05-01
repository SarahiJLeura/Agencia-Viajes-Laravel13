<?php

namespace App\Services;

use App\Models\Transporte;
use Illuminate\Support\Facades\Http;

class TransporteApiService
{
    protected $baseUrl;
    
    public function __construct()
    {
        // Para consumir la API interna de Laravel
        $this->baseUrl = env('APP_URL', 'http://localhost:8000');
    }
    
    /**
     * Obtener todos los transportes activos
     */
    public function obtenerTransportes()
    {
        try {
            $response = Http::timeout(5)->get($this->baseUrl . '/api/transportes');
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }
            
            return $this->getTransportesLocal();
        } catch (\Exception $e) {
            return $this->getTransportesLocal();
        }
    }
    
    /**
     * Obtener un transporte por ID
     */
    public function obtenerTransporte($id)
    {
        try {
            $response = Http::get($this->baseUrl . '/api/transportes/' . $id);
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? null;
            }
            
            return Transporte::find($id);
        } catch (\Exception $e) {
            return Transporte::find($id);
        }
    }
    
    /**
     * Fallback: obtener transportes directamente de la BD
     */
    private function getTransportesLocal()
    {
        return Transporte::where('activo', true)
            ->select('id', 'tipo', 'placa', 'capacidad', 'modelo')
            ->get()
            ->toArray();
    }
}