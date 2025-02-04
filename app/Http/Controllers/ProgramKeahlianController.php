<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $program_keahlians = ProgramKeahlian::with('bidangKeahlian')->get();
        return view('program_keahlian.index', compact('program_keahlians'));
    } 

    public function create()
    {
        $bidang_keahlians = BidangKeahlian::all();
        return view('program_keahlian.create', compact('bidang_keahlians'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_bidang_keahlian' => 'required|exists:tbl_bidang_keahlian,id_bidang_keahlian',
            'kode_program_keahlian' => 'required|max:10|unique:tbl_program_keahlian,kode_program_keahlian',
            'program_keahlian' => 'required|max:100'
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ProgramKeahlian::create($request->all());
        return redirect()->route('program_keahlian.index')
            ->with('success', 'Program Keahlian berhasil ditambahkan');
    }

    public function edit(ProgramKeahlian $program_keahlian)
    {
        $bidang_keahlians = BidangKeahlian::all();
        return view('program_keahlian.edit', compact('program_keahlian', 'bidang_keahlians'));
    }

    public function update(Request $request, ProgramKeahlian $program_keahlian)
    { 
        $validator = Validator::make($request->all(), [
            'id_bidang_keahlian' => 'required|exists:tbl_bidang_keahlian,id_bidang_keahlian',
            'kode_program_keahlian' => ['required','max:10',
                Rule::unique('tbl_program_keahlian', 'kode_program_keahlian')
                    ->ignore($program_keahlian->id_program_keahlian,'id_program_keahlian')
            ],
            'program_keahlian' => 'required|max:100'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        
        $program_keahlian->update($request->all());
        return redirect()->route('program_keahlian.index')
            ->with('success', 'Program Keahlian berhasil diupdate');
    }

    public function destroy(ProgramKeahlian $program_keahlian)
    {
        try {
            $program_keahlian->delete();
            return redirect()->route('program_keahlian.index')
                ->with('success', 'Program Keahlian berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('program_keahlian.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}