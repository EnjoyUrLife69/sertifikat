<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function index()
    {
        //get all posts
        $training = Training::latest()->paginate(5);

        //return collection of training as a resource
        return new TrainingResource(true, 'List Data training', $training);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_training' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kode' => 'required|string|max:50',
            'konten' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $cover = $request->file('cover');
        $coverPath = $cover->storeAs('public/training', $cover->hashName());

        // Create training record
        $training = Training::create([
            'cover' => $cover->hashName(),
            'nama_training' => $request->nama_training,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kode' => $request->kode,
            'konten' => $request->konten,
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Training Berhasil Ditambahkan!',
            'data' => $training,
        ], 201);
    }

    public function show($id)
    {
        //find post by ID
        $training = Training::find($id);

        //return single post as a resource
        return new TrainingResource(true, 'Detail Data Training!', $training);
    }

    public function update(Request $request, $id)
    {
        // Find the existing training record by ID
        $training = Training::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_training' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kode' => 'required|string|max:50',
            'konten' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if cover image is uploaded
        if ($request->hasFile('cover')) {
            // Delete the old image if exists
            if ($training->cover) {
                Storage::delete('public/training/' . $training->cover);
            }

            // Upload the new image
            $cover = $request->file('cover');
            $cover->storeAs('public/training', $cover->hashName());

            // Update cover in the database
            $training->cover = $cover->hashName();
        }

        // Update other training details
        $training->nama_training = $request->nama_training;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;
        $training->konten = $request->konten;

        // Save the changes to the database
        $training->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Training Berhasil Diperbarui!',
            'data' => $training,
        ], 200);
    }

    public function destroy($id)
    {

        //find post by ID
        $training = Training::find($id);

        //delete image
        Storage::delete('public/training/' . basename($training->cover));

        //delete training
        $training->delete();

        //return response
        return new trainingResource(true, 'Data training Berhasil Dihapus!', null);
    }

}
