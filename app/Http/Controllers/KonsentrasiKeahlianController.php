<?php

namespace App\Http\Controllers;

use App\Models\KonsentrasiKeahlian;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KonsentrasiKeahlianController extends Controller
{
    public function index()
    {
        $konsentrasi_keahlians = KonsentrasiKeahlian::with('programKeahlian')->get();
        return view('konsentrasi_keahlian.index', compact('konsentrasi_keahlians'));
    } 

    public function create()
    {
        $program_keahlians = ProgramKeahlian::all();
        return view('konsentrasi_keahlian.create', compact('program_keahlians'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_program_keahlian' => 'required|exists:tbl_program_keahlian,id_program_keahlian',
            'kode_konsentrasi_keahlian' => 'required|max:10|unique:tbl_konsentrasi_keahlian,kode_konsentrasi_keahlian',
            'konsentrasi_keahlian' => 'required|max:100'
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        KonsentrasiKeahlian::create($request->all());
        return redirect()->route('konsentrasi_keahlian.index')
            ->with('success', 'Konsentrasi Keahlian berhasil ditambahkan');
    }

    public function edit(KonsentrasiKeahlian $konsentrasi_keahlian)
    {
        $program_keahlians = ProgramKeahlian::all();
        return view('konsentrasi_keahlian.edit', compact('konsentrasi_keahlian', 'program_keahlians'));
    }

    public function update(Request $request, KonsentrasiKeahlian $konsentrasi_keahlian)
    { 
        $validator = Validator::make($request->all(), [
            'id_program_keahlian' => 'required|exists:tbl_program_keahlian,id_program_keahlian',
            'kode_konsentrasi_keahlian' => ['required','max:10',
                Rule::unique('tbl_konsentrasi_keahlian', 'kode_konsentrasi_keahlian')
                    ->ignore($konsentrasi_keahlian->id_konsentrasi_keahlian,'id_konsentrasi_keahlian')
            ],
            'konsentrasi_keahlian' => 'required|max:100'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        
        $konsentrasi_keahlian->update($request->all());
        return redirect()->route('konsentrasi_keahlian.index')
            ->with('success', 'Konsentrasi Keahlian berhasil diupdate');
    }

    public function destroy(KonsentrasiKeahlian $konsentrasi_keahlian)
    {
        try {
            $konsentrasi_keahlian->delete();
            return redirect()->route('konsentrasi_keahlian.index')
                ->with('success', 'Konsentrasi Keahlian berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('konsentrasi_keahlian.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}