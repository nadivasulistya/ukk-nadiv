<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolahs = Sekolah::all();
        return view('sekolah.index', compact('sekolahs'));
    } 

    public function create()
    {
        return view('sekolah.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npsn' => 'required|max:10|unique:tbl_sekolah,npsn',
            'nss' => 'required|max:20|unique:tbl_sekolah,nss',
            'nama_sekolah' => 'required|max:50',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'website' => 'nullable|max:50',
            'email' => 'required|email|max:50|unique:tbl_sekolah,email'
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->all());
            Sekolah::create($request->all());
            return redirect()->route('sekolah.index')
                ->with('success', 'Sekolah berhasil ditambahkan');
   
    }

    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, Sekolah $sekolah)
    { 
        $validator = Validator::make($request->all(), [
            'npsn' => ['required','max:10',
            Rule::unique('tbl_sekolah', 'npsn')->ignore($sekolah->id_sekolah,'id_sekolah')],
            'nss' =>  ['required','max:20',
            Rule::unique('tbl_sekolah', 'nss')->ignore($sekolah->id_sekolah,'id_sekolah')],
            'nama_sekolah' => 'required|max:50',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'website' => 'nullable|max:50',
            'email' =>  ['required','email','max:50',
            Rule::unique('tbl_sekolah', 'email')->ignore($sekolah->id_sekolah,'id_sekolah')],
        ]);
    
        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $sekolah->update($request->all());
        return redirect()->route('sekolah.index')
            ->with('success', 'Sekolah berhasil diupdate');
    }
    public function destroy(Sekolah $sekolah)
    {
        try {
            $sekolah->delete();
            return redirect()->route('sekolah.index')
                ->with('success', 'Sekolah berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('sekolah.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}