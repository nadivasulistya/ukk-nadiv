<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::with('alumni')->latest()->get();
        return view('testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        $alumnis = Alumni::all();
        return view('testimoni.create', compact('alumnis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_alumni' => 'required|exists:tbl_alumni,id_alumni',
            'testimoni' => 'required|string|max:1000',
            'tgl_testimoni' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Testimoni::create($request->all());
        return redirect()->route('home')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit(Testimoni $testimoni)
    {
        $alumnis = Alumni::all();
        return view('testimoni.edit', compact('testimoni', 'alumnis'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = Validator::make($request->all(), [
            'id_alumni' => 'required|exists:tbl_alumni,id_alumni',
            'testimoni' => 'required|string|max:1000',
            'tgl_testimoni' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $testimoni->update($request->all());
        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil diupdate');
    }

    public function destroy(Testimoni $testimoni)
    {
        try {
            $testimoni->delete();
            return redirect()->route('testimoni.index')
                ->with('success', 'Testimoni berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('testimoni.index')
                ->with('error', 'Gagal menghapus testimoni: ' . $e->getMessage());
        }
    }

    public function show(Testimoni $testimoni)
    {
        return view('testimoni.show', compact('testimoni'));
    }
}