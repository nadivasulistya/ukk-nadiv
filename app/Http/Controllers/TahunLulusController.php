<?php
namespace App\Http\Controllers;

use App\Models\TahunLulus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TahunLulusController extends Controller 
{
    public function index() 
    {
        $tahunLulus = TahunLulus::paginate(10);
        return view('tahun_lulus.index', compact('tahunLulus'));
    }

    public function create() 
    {
        return view('tahun_lulus.create');
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'tahun_lulus' => 'required|max:10|unique:tbl_tahun_lulus,tahun_lulus',
            'keterangan' => 'nullable|max:50'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        TahunLulus::create($request->all());
        return redirect()->route('tahun_lulus.index')
            ->with('success', 'Tahun Lulus berhasil ditambahkan');
    }

    public function show(TahunLulus $tahunLulus) 
    {
        return view('tahun_lulus.show', compact('tahunLulus'));
    }

    public function edit( $tahunLulus) 
    {
      $tahunLulus = TahunLulus::findOrFail($tahunLulus);
  
        return view('tahun_lulus.edit', compact('tahunLulus'));
    }

    public function update(Request $request, $id)
    {
        $tahunLulus = TahunLulus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'tahun_lulus' => [
                'required',
                'max:10',
                Rule::unique('tbl_tahun_lulus')->ignore($tahunLulus->id_tahun_lulus, 'id_tahun_lulus')
            ],
            'keterangan' => 'nullable|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tahunLulus->update($request->all());
        return redirect()->route('tahun_lulus.index')
            ->with('success', 'Tahun Lulus berhasil diperbarui');
    }

    public function destroy(TahunLulus $tahunLulus) 
    {
        try {
            // Periksa apakah tahun lulus memiliki alumni
            if ($tahunLulus->alumni()->exists()) {
                return redirect()->route('tahun_lulus.index')
                    ->with('error', 'Tahun Lulus tidak dapat dihapus karena masih memiliki data alumni');
            }

            $tahunLulus->delete();
            return redirect()->route('tahun_lulus.index')
                ->with('success', 'Tahun Lulus berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('tahun_lulus.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}