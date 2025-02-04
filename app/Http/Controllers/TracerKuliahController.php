<?php
namespace App\Http\Controllers;

use App\Models\TracerKuliah;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TracerKuliahController extends Controller 
{
    public function index() 
    {
        $tracerKuliahs = TracerKuliah::all();
        return view('tracer_kuliah.index', compact('tracerKuliahs'));
    }

    public function create() 
    {
        $alumnis = Alumni::all();
        return view('tracer_kuliah.create', compact('alumnis'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'id_alumni' => 'required|exists:tbl_alumni,id_alumni',
            'tracer_kuliah_kampus' => 'required|max:45',
            'tracer_kuliah_status' => 'required|max:45',
            'tracer_kuliah_jenjang' => 'required|max:45',
            'tracer_kuliah_jurusan' => 'required|max:45',
            'tracer_kuliah_linier' => 'required|max:45',
            'tracer_kuliah_alamat' => 'required|max:45'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            TracerKuliah::create($request->all());
            // Redirect ke halaman create testimoni
            return redirect()->route('testimoni.create')
                ->with('success', 'Data tracer kuliah berhasil disimpan. Silahkan isi testimoni Anda.');
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error saat menyimpan data:', ['message' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(TracerKuliah $tracerKuliah) 
    {
        return view('tracer_kuliah.edit', compact('tracerKuliah'));
    }

    public function update(Request $request, TracerKuliah $tracerKuliah) 
    {
        $validator = Validator::make($request->all(), [
            'id_alumni' => ['required', 'exists:tbl_alumni,id_alumni'],
            'tracer_kuliah_kampus' => 'required|max:45',
            'tracer_kuliah_status' => 'required|max:45',
            'tracer_kuliah_jenjang' => 'required|max:45',
            'tracer_kuliah_jurusan' => 'required|max:45',
            'tracer_kuliah_linier' => 'required|max:45',
            'tracer_kuliah_alamat' => 'required|max:45'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tracerKuliah->update($request->all());
        return redirect()->route('home')
            ->with('success', 'Data Tracer Kuliah berhasil diupdate');
    }

    public function destroy(TracerKuliah $tracerKuliah) 
    {
        try {
            $tracerKerja = TracerKuliah::create($request->all());
            // Log sukses
            \Log::info('Data berhasil disimpan:', $tracerKuliah->toArray());
            return redirect()->route('testimoni.create')
                ->with('success', 'Data Tracer Kuliah berhasil ditambahkan. Silahkan isi testimoni Anda.');
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error saat menyimpan data:', ['message' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}