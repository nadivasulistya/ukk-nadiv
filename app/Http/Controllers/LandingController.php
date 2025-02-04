<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
class LandingController extends Controller
{
    public function index(): View
    {
        // Ambil testimoni user yang sedang login (jika sudah login)
        $userTestimoni = null;
        if (Auth::check()) {
            $userTestimoni = Testimoni::with('alumni')
                ->whereHas('alumni', function($query) {
                    $query->where('id_user', Auth::id());
                })
                ->latest()
                ->first();
        }

        $sekolah = Sekolah::first();
        // Ambil testimoni terbaru untuk ditampilkan
        $recentTestimonis = Testimoni::with('alumni')


            ->latest()
            ->take(5)
            ->get();

        return view('users.home', compact('userTestimoni', 'recentTestimonis', 'sekolah'));
    }
} 