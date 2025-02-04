<?php

namespace App\Http\Controllers;

use App\Models\BidangKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BidangKeahlianController extends Controller
{
    public function index()
    {
        $bidang_keahlians = BidangKeahlian::all();
        return view('bidang_keahlian.index', compact('bidang_keahlians'));
    } 

    public function create()
    {
        return view('bidang_keahlian.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_bidang_keahlian' => 'required|max:10|unique:tbl_bidang_keahlian,kode_bidang_keahlian',
            'bidang_keahlian' => 'required|max:100'
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BidangKeahlian::create($request->all());
        return redirect()->route('bidang_keahlian.index')
            ->with('success', 'Bidang Keahlian berhasil ditambahkan');
    }

    public function edit(BidangKeahlian $bidang_keahlian)
    {
        return view('bidang_keahlian.edit', compact('bidang_keahlian'));
    }

    public function update(Request $request, BidangKeahlian $bidang_keahlian)
    { 
        $validator = Validator::make($request->all(), [
            'kode_bidang_keahlian' => ['required','max:10',
            Rule::unique('tbl_bidang_keahlian', 'kode_bidang_keahlian')->ignore($bidang_keahlian->id_bidang_keahlian,'id_bidang_keahlian')],
            'bidang_keahlian' => 'required|max:100'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        
        $bidang_keahlian->update($request->all());
        return redirect()->route('bidang_keahlian.index')
            ->with('success', 'Bidang Keahlian berhasil diupdate');
    }

    public function destroy(BidangKeahlian $bidang_keahlian)
    {
        try {
            $bidang_keahlian->delete();
            return redirect()->route('bidang_keahlian.index')
                ->with('success', 'Bidang Keahlian berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('bidang_keahlian.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}