<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\TahunLulus;
use App\Models\KonsentrasiKeahlian;
use App\Models\StatusAlumni;
use App\Models\Testimoni;
use App\Models\RawStudentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis = Alumni::with(['konsentrasiKeahlian', 'tahunLulus', 'tracerKerja', 'tracerKuliah'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('alumni.index', compact('alumnis'));
    }

    public function create()
    {
        $tahunLulus = TahunLulus::all();
        $konsentrasiKeahlian = KonsentrasiKeahlian::all();
        $statusAlumni = StatusAlumni::all();
        return view('alumni.create', compact('tahunLulus', 'konsentrasiKeahlian', 'statusAlumni'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nisn' => 'required|unique:tbl_alumni|max:20',
            'nik' => 'required|unique:tbl_alumni|max:20',
            'nama_depan' => 'required|max:50',
            'nama_belakang' => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|max:50',
            'no_hp' => 'required|max:15',
            'email' => 'required|email|unique:tbl_alumni|max:50',
            'password' => 'required|min:6',
            'id_tahun_lulus' => 'required|exists:tbl_tahun_lulus,id_tahun_lulus',
            'id_konsentrasi_keahlian' => 'required|exists:tbl_konsentrasi_keahlian,id_konsentrasi_keahlian',
            'id_status_alumni' => 'required|exists:tbl_status_alumni,id_status_alumni',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['status_login'] = '0';

        Alumni::create($data);

        return redirect()->route('alumni.index')
            ->with('success', 'Data Alumni berhasil ditambahkan');
    }

    public function edit( $alumni)
    { 
        $alumni = Alumni::findOrFail($alumni);
        $tahunLulus = TahunLulus::all();
        $konsentrasiKeahlian = KonsentrasiKeahlian::all();
        $statusAlumni = StatusAlumni::all();
        return view('alumni.edit', compact('alumni', 'tahunLulus', 'konsentrasiKeahlian', 'statusAlumni'));
    }

    public function update(Request $request, $alumni)
    {   
        $alumni = Alumni::findOrFail($alumni);
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|max:20|unique:tbl_alumni,nisn,' . $alumni->id_alumni . ',id_alumni',
            'nik' => 'required|max:20|unique:tbl_alumni,nik,' . $alumni->id_alumni . ',id_alumni',
            'nama_depan' => 'required|max:50',
            'nama_belakang' => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|max:50',
            'no_hp' => 'required|max:15',
            'password' => 'nullable|min:6',
            'id_tahun_lulus' => 'required|exists:tbl_tahun_lulus,id_tahun_lulus',
            'id_konsentrasi_keahlian' => 'required|exists:tbl_konsentrasi_keahlian,id_konsentrasi_keahlian',
            'id_status_alumni' => 'required|exists:tbl_status_alumni,id_status_alumni',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $alumni->update($data);

        return redirect('/alumni')
            ->with('success', 'Data Alumni berhasil diupdate');
    }

    public function destroy($alumni)
    {
        $alumni = Alumni::findOrFail($alumni);
        dd($alumni);
        try {
            $alumni->delete();
            return redirect()->route('alumni.index')
                ->with('success', 'Data Alumni berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('alumni.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function showRegistrationForm()
    {
        $tahunLulus = TahunLulus::all();
        $konsentrasiKeahlian = KonsentrasiKeahlian::all();
        $statusAlumni = StatusAlumni::all();
        $testimonis = Testimoni::with('alumni')->latest()->get();

        return view('alumni.register', compact(
            'tahunLulus',
            'konsentrasiKeahlian',
            'statusAlumni',
            'testimonis'
        ));
    }

    public function registerAlumni(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|unique:tbl_alumni',
            'nisn' => 'required|unique:tbl_alumni|max:20',
            'nik' => 'required|unique:tbl_alumni|max:20',
            'nama_depan' => 'required|max:50',
            'nama_belakang' => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|max:50',
            'no_hp' => 'required|max:15',
            'id_tahun_lulus' => 'required|exists:tbl_tahun_lulus,id_tahun_lulus',
            'id_konsentrasi_keahlian' => 'required|exists:tbl_konsentrasi_keahlian,id_konsentrasi_keahlian',
            'id_status_alumni' => 'required|exists:tbl_status_alumni,id_status_alumni',
            'akun_fb' => 'nullable|max:50',
            'akun_ig' => 'nullable|max:50',
            'akun_tiktok' => 'nullable|max:50',
        ], [
            'id_status_alumni.required' => 'Status alumni wajib dipilih',
            'id_status_alumni.exists' => 'Status alumni tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->all();
            $data['status_login'] = '1';
            $data['email'] = Auth::user()->email;
            $data['password'] = Auth::user()->password;

            Alumni::create($data);

            return redirect()->route('home')
                ->with('success', 'Pendaftaran alumni berhasil! Sekarang Anda dapat mengisi kuesioner tracer study.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {

        $alumni = Alumni::with([
            'user',
            'tahunLulus',
            'konsentrasiKeahlian',
            'tracerKerja',
            'tracerKuliah'
        ])->findOrFail($id);

        return view('admin.alumni_detail', compact('alumni'));
    }

    public function searchStudent(Request $request)
    {
        $term = $request->get('term');
        
        $students = RawStudentData::where('name', 'LIKE', "%{$term}%")
            ->select('name', 'nisn', 'nik')
            ->limit(5)
            ->get();
            
        return response()->json($students);
    }
}
