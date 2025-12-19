<?php

namespace App\Http\Controllers\Api;

use App\Models\Sertifikat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    
    public function index()
    {
        return Sertifikat::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try {
        $validated = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB max
            'id_siswa' => 'required|integer'  // Add validation for id_siswa
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('sertifikat', 'public');
            $validated['file'] = $path;
        }

        $data = Sertifikat::create($validated);
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
