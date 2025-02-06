<?php
// File: app/Http/Controllers/IdentitasController.php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdentitasController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $validated = $request->validate([
                'nama_depan' => 'required|string|max:50',
                'nama_belakang' => 'required|string|max:50',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'required|string|max:20',
                'tgl_lahir' => 'required|date',
                'alamat' => 'required|string|max:50',
                'no_hp' => 'required|string|max:15',
                'email' => 'required|email|unique:tbl_alumni,email'
            ]);

            // Simpan data alumni
            $alumni = Alumni::create($validated);

            // Generate dan simpan NISN & NIK
            $identitas = new Identitas([
                'id_alumni' => $alumni->id_alumni,
                'nisn' => Identitas::generateNISN($request->tgl_lahir, $request->nama_depan),
                'nik' => Identitas::generateNIK($request->tgl_lahir, $request->jenis_kelamin)
            ]);
            $identitas->save();

            DB::commit();

            return redirect()
                ->route('alumni.index')
                ->with('success', 'Data alumni berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating alumni: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data alumni.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $alumni = Alumni::findOrFail($id);

            // Validasi input
            $validated = $request->validate([
                'nama_depan' => 'required|string|max:50',
                'nama_belakang' => 'required|string|max:50',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'required|string|max:20',
                'tgl_lahir' => 'required|date',
                'alamat' => 'required|string|max:50',
                'no_hp' => 'required|string|max:15',
                'email' => 'required|email|unique:tbl_alumni,email,'.$id.',id_alumni'
            ]);

            // Update data alumni
            $alumni->update($validated);

            // Update NISN & NIK jika ada perubahan
            if ($request->tgl_lahir !== $alumni->getOriginal('tgl_lahir') ||
                $request->jenis_kelamin !== $alumni->getOriginal('jenis_kelamin')) {
                
                $alumni->identitas->update([
                    'nisn' => Identitas::generateNISN($request->tgl_lahir, $request->nama_depan),
                    'nik' => Identitas::generateNIK($request->tgl_lahir, $request->jenis_kelamin)
                ]);
            }

            DB::commit();

            return redirect()
                ->route('alumni.show', $alumni->id_alumni)
                ->with('success', 'Data alumni berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating alumni: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data alumni.');
        }
    }

    // API untuk generate NISN dan NIK
    public function generateIdentitas(Request $request)
    {
        try {
            $nisn = Identitas::generateNISN(
                $request->tgl_lahir,
                $request->nama_depan
            );
            
            $nik = Identitas::generateNIK(
                $request->tgl_lahir,
                $request->jenis_kelamin
            );

            return response()->json([
                'status' => 'success',
                'data' => [
                    'nisn' => $nisn,
                    'nik' => $nik
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error generating identitas: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal generate data identitas'
            ], 500);
        }
    }
};