<?php
namespace App\Http\Controllers;

use App\Models\TracerKerja;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TracerKerjaController extends Controller
{
    public function index()
    {
        $tracerKerjas = TracerKerja::with('alumni')->get();
        return view('tracer_kerja.index', compact('tracerKerjas'));
    }

    public function create()
    {
        $alumnis = Alumni::all();
        return view('tracer_kerja.create', compact('alumnis'));
    }

    public function store(Request $request)
    {
        // Log data yang diterima
        \Log::info('Data Tracer Kerja yang diterima:', $request->all());

        $validator = Validator::make($request->all(), [
            'id_alumni' => 'required|exists:tbl_alumni,id_alumni',
            'tracer_kerja_pekerjaan' => 'required|max:50',
            'tracer_kerja_nama' => 'required|max:50',
            'tracer_kerja_jabatan' => 'required|max:50',
            'tracer_kerja_status' => 'required|max:50',
            'tracer_kerja_lokasi' => 'required|max:50',
            'tracer_kerja_alamat' => 'required|max:50',
            'tracer_kerja_tgl_mulai' => 'required|date',
            'tracer_kerja_gaji' => 'required|regex:/^Rp\s\d{1,3}(\.\d{3})*$/'
        ]);

        if ($validator->fails()) {
            // Log error validasi
            \Log::error('Validation errors:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $tracerKerja = TracerKerja::create($request->all());
            // Log sukses
            \Log::info('Data berhasil disimpan:', $tracerKerja->toArray());
            return redirect()->route('testimoni.create')
                ->with('success', 'Data Tracer Kerja berhasil ditambahkan. Silahkan isi testimoni Anda.');
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error saat menyimpan data:', ['message' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(TracerKerja $tracerKerja)
    {
        $alumnis = Alumni::all();
        return view('tracer_kerja.edit', compact('tracerKerja', 'alumnis'));
    }

    public function update(Request $request, TracerKerja $tracerKerja)
    {
        $validator = Validator::make($request->all(), [
            'id_alumni' => 'required|exists:tbl_alumni,id_alumni',
            'tracer_kerja_pekerjaan' => 'required|max:50',
            'tracer_kerja_nama' => 'required|max:50',
            'tracer_kerja_jabatan' => 'required|max:50',
            'tracer_kerja_status' => 'required|max:50',
            'tracer_kerja_lokasi' => 'required|max:50',
            'tracer_kerja_alamat' => 'required|max:50',
            'tracer_kerja_tgl_mulai' => 'required|date',
            'tracer_kerja_gaji' => 'required|regex:/^Rp\s\d{1,3}(\.\d{3})*$/'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tracerKerja->update($request->all());
        return redirect()->route('tracer_kerja.index')
            ->with('success', 'Data Tracer Kerja berhasil diupdate');
    }

    public function destroy(TracerKerja $tracerKerja)
    {
        try {
            $tracerKerja->delete();
            return redirect()->route('tracer_kerja.index')
                ->with('success', 'Data Tracer Kerja berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('tracer_kerja.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Metode tambahan untuk laporan atau filter
    public function laporan()
    {
        $tracerKerjas = TracerKerja::with('alumni')
            ->select('id_alumni', 
                DB::raw('COUNT(*) as total_pekerjaan'),
                DB::raw('AVG(REPLACE(tracer_kerja_gaji, "Rp ", "")) as rata_gaji')
            )
            ->groupBy('id_alumni')
            ->get();

        return view('tracer_kerja.laporan', compact('tracerKerjas'));
    }

    public function filter(Request $request)
    {
        $query = TracerKerja::with('alumni');

        if ($request->filled('status')) {
            $query->where('tracer_kerja_status', $request->status);
        }

        if ($request->filled('rentang_gaji')) {
            // Contoh filter rentang gaji
            $query->where('tracer_kerja_gaji', '>=', $request->rentang_gaji);
        }

        $tracerKerjas = $query->get();

        return view('testimoni.index', compact('tracerKerjas'));
    }
}