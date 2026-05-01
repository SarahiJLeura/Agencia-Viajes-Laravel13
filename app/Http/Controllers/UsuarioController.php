<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::paginate(15);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role' => 'required|in:user,admin',
        ]);

        $data = $request->only(['name', 'email', 'role']);
        
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }
        
        $usuario->delete();
        
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }

    public function importarCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');
        $header = fgetcsv($handle, 1000, ',');
        
        $importados = 0;
        $errores = [];

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $row = array_combine($header, $data);
            
            try {
                User::updateOrCreate(
                    ['email' => $row['email'] ?? null],
                    [
                        'name' => $row['name'] ?? $row['nombre'] ?? 'Sin nombre',
                        'password' => Hash::make($row['password'] ?? 'password123'),
                        'role' => $row['role'] ?? 'user',
                    ]
                );
                $importados++;
            } catch (\Exception $e) {
                $errores[] = $row['email'] ?? 'Fila sin email';
            }
        }
        
        fclose($handle);

        $mensaje = "Se importaron {$importados} usuarios exitosamente.";
        if (count($errores) > 0) {
            $mensaje .= " Errores en: " . implode(', ', $errores);
        }
        
        return redirect()->route('admin.usuarios.index')
            ->with('success', $mensaje);
    }

    public function exportarCSV()
    {
        $usuarios = User::all();
        $filename = 'usuarios_' . date('Y-m-d') . '.csv';
        
        $handle = fopen('php://temp', 'w');
        fputcsv($handle, ['ID', 'Nombre', 'Email', 'Rol', 'Fecha Registro']);
        
        foreach ($usuarios as $usuario) {
            fputcsv($handle, [
                $usuario->id,
                $usuario->name,
                $usuario->email,
                $usuario->role,
                $usuario->created_at->format('Y-m-d H:i:s'),
            ]);
        }
        
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        return response($content, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}