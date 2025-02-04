<?php
namespace App\Http\Controllers;

use App\Models\StatusAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusAlumniController extends Controller 
{
    public function index() 
    {
        $statusAlumni = StatusAlumni::paginate(10);
        return view('status_alumni.index', compact('statusAlumni'));
    }

    public function create() 
    {
        return view('status_alumni.create');
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|max:25|unique:tbl_status_alumni,status'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        StatusAlumni::create($request->all());
        return redirect()->route('status_alumni.index')
            ->with('success', 'Status Alumni berhasil ditambahkan');
    }

    public function edit(StatusAlumni $statusAlumni) 
    {
        return view('statu_alumni.edit', compact('statusAlumni'));
    }

    public function update(Request $request, StatusAlumni $statusAlumni) 
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|max:25|unique:tbl_status_alumni,status,' . $statusAlumni->id_status_alumni . ',id_status_alumni'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $statusAlumni->update($request->all());
        return redirect()->route('status_alumni.index')
            ->with('success', 'Status Alumni berhasil diupdate');
    }

    public function destroy(StatusAlumni $statusAlumni) 
    {
        try {
            // Cek apakah status alumni memiliki alumni terkait
            if ($statusAlumni->alumni()->exists()) {
                return redirect()->route('status_alumni.index')
                    ->with('error', 'Status Alumni tidak dapat dihapus karena masih memiliki data alumni');
            }

            $statusAlumni->delete();
            return redirect()->route('status_alumni.index')
                ->with('success', 'Status Alumni berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('status_alumni.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}