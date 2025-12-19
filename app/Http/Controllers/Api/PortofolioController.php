<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Log;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Portofolio::all();
    }

    /**
     * Store a newly created resource in storage.
     */
            public function store(Request $request)
    {
        try {
            // Log what you're receiving
            Log::info('Received data:', $request->all());
            
            $validated = $request->validate([
                'nama' => 'required|string',
                'deskripsi' => 'nullable|string',
                'durasiPengerjaan' => 'nullable|string',
                'linkPortofolio' => 'nullable|string',
                'gambar' => 'nullable|image|max:2048',
                'id_siswa' => 'required|integer'  // Add validation for id_siswa
            ]);

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('portofolio', 'public');
                $validated['gambar'] = $path;
            }

            // Log what you're trying to save
            Log::info('Data to save:', $validated);

            $data = Portofolio::create($validated);
            
            // Log what actually got saved
            Log::info('Saved data:', $data->toArray());
            
            return response()->json($data, 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
