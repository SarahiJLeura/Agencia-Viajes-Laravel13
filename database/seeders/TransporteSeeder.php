<?php

namespace Database\Seeders;

use App\Models\Transporte;
use Illuminate\Database\Seeder;

class TransporteSeeder extends Seeder
{
    public function run(): void
    {
        $transportes = [
            ['tipo' => 'Aéreo', 'placa' => 'GQ-8821', 'capacidad' => 180, 'modelo' => 'Boeing 737'],
            ['tipo' => 'Aéreo', 'placa' => 'GQ-8822', 'capacidad' => 250, 'modelo' => 'Airbus A320'],
            ['tipo' => 'Terrestre', 'placa' => 'B-5542-TQ', 'capacidad' => 45, 'modelo' => 'Mercedes Benz'],
            ['tipo' => 'Terrestre', 'placa' => 'ELECT-01', 'capacidad' => 4, 'modelo' => 'Tesla Model X'],
            ['tipo' => 'Terrestre', 'placa' => 'GQ-7712', 'capacidad' => 50, 'modelo' => 'Volvo 9700'],
            ['tipo' => 'Marítimo', 'placa' => 'M-882-GQ', 'capacidad' => 120, 'modelo' => 'Catamaran'],
        ];

        foreach ($transportes as $transporte) {
            Transporte::create($transporte);
        }
    }
}