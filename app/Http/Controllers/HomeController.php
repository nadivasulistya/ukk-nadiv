<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Testimoni;
use App\Models\Alumni;
use Carbon\Carbon;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {

        // Ambil testimoni user yang sedang login
        $userTestimoni = Testimoni::with('alumni')
            ->whereHas('alumni', function($query) {
                $query->where('id_user', Auth::id());
            })
            ->latest()
            ->first();

        // Ambil semua testimoni untuk ditampilkan
        $recentTestimonis = Testimoni::with('alumni')
            ->latest()
            ->take(5)
            ->get();

        $sekolah = Sekolah::first();
        return view('users.home', compact('userTestimoni', 'recentTestimonis', 'sekolah'));
    } 
  
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        // Get alumni registrations for the last 7 days
        $sekolah = Sekolah::first();
        $lastSevenDays = collect(range(6, 0))->map(function ($days) {
            $date = Carbon::now()->subDays($days);
            
            $count = Alumni::whereDate('created_at', $date->toDateString())->count();
            
            return [
                'label' => $date->format('d M'),
                'count' => $count
            ];
        });

        return view('Admin.adminHome', compact('lastSevenDays'));
    }

    // Tambahkan method ini untuk handle route lainnya yang menggunakan layout yang sama
    public function anyPage()
    {
        // Ambil testimoni user yang sedang login
        $userTestimoni = Testimoni::with('alumni')
            ->whereHas('alumni', function($query) {
                $query->where('id_user', Auth::id());
            })
            ->latest()
            ->first();

        // Ambil semua testimoni untuk ditampilkan
        $recentTestimonis = Testimoni::with('alumni')
            ->latest()
            ->take(5)
            ->get();
        
        // Detect the current route name
        $routeName = request()->route()->getName();
        
        // Return appropriate view based on route
        return view($routeName, compact('userTestimoni', 'recentTestimonis'));
    }
}
