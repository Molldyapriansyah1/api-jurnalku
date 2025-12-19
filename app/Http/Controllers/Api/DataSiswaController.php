<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSiswa;



class DataSiswaController extends Controller
{
    public function index()
    {
        return DataSiswa::with(['user','portofolio','sertifikat'])->get();
        // This will still work and now show ALL portfolios and certificates per student
    }

    public function show($id)
    {
        return DataSiswa::with(['user','portofolio','sertifikat'])
            ->findOrFail($id);
    }

        public function store(Request $request)
    {
        // 1. Collect all text data
        $input = $request->except('PFP'); 

        // 2. Handle the file upload manually
        if ($request->hasFile('PFP')) {
            // This stores the file in storage/app/public/images
            $path = $request->file('PFP')->store('images', 'public');
            // This saves the path (e.g., "images/filename.jpg") to the database
            $input['PFP'] = $path; 
        }

        try {
            $data = DataSiswa::create($input);
            return response()->json($data, 201);
        } catch (\Exception $e) {
            // This will help you see the REAL error in Postman if it fails again
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = DataSiswa::findOrFail($id);
        $data->update($request->all());
        return response()->json($data);
    }

    public function destroy($id)
    {
        DataSiswa::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
