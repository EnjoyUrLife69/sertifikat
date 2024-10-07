<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();

        //return collection of role as a resource
        return new RoleResource(true, 'List Data Role', $role);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required|string|max:255',
            'deskripsi_role' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create sertifikat
        $role = Role::create([
            'nama_role' => $request->nama_role,
            'deskripsi_role' => $request->deskripsi_role,
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Role Berhasil Ditambahkan!',
            'data' => $role,
        ], 201);
    }

    public function show($id)
    {
        //find post by ID
        $role = Role::find($id);

        //return single post as a resource
        return new RoleResource(true, 'Detail Data role!', $role);
    }

    public function update(Request $request, $id)
    {
        // Find the existing training record by ID
        $role = Role::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required|string|max:255',
            'deskripsi_role' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update other training details
        $role->nama_role = $request->nama_role;
        $role->deskripsi_role = $request->deskripsi_role;

        // Save the changes to the database
        $role->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Role Berhasil Diperbarui!',
            'data' => $role,
        ], 200);
    }

    public function destroy($id)
    {

        //find post by ID
        $role = Role::find($id);

        //delete sertifikat
        $role->delete();

        //return response
        return new RoleResource(true, 'Data Role Berhasil Dihapus!', null);
    }

}
