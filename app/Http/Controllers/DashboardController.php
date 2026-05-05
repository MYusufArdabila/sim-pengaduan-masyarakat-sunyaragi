<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'warga') {
            $total_menunggu = Complaint::where('user_id', $user->id)->where('status', 'Menunggu')->count();
            $total_diproses = Complaint::where('user_id', $user->id)->where('status', 'Diproses')->count();
            $total_selesai  = Complaint::where('user_id', $user->id)->where('status', 'Selesai')->count();
            $total_all      = Complaint::where('user_id', $user->id)->count();

            return view('dashboard', compact('total_menunggu', 'total_diproses', 'total_selesai', 'total_all'));
        }

        // Admin: statistik global
        $total_menunggu = Complaint::where('status', 'Menunggu')->count();
        $total_diproses = Complaint::where('status', 'Diproses')->count();
        $total_selesai  = Complaint::where('status', 'Selesai')->count();
        $total_all      = Complaint::count();

        // Data grafik bulanan (6 bulan terakhir)
        $months = collect(range(5, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        });

        $monthly_data = $months->map(function ($month) {
            return Complaint::whereYear('created_at', substr($month, 0, 4))
                ->whereMonth('created_at', substr($month, 5, 2))
                ->count();
        });

        $monthly_labels = $months->map(function ($month) {
            return Carbon::createFromFormat('Y-m', $month)->locale('id')->isoFormat('MMM YYYY');
        });

        // Data grafik per status (pie)
        $status_data = [
            $total_menunggu,
            $total_diproses,
            $total_selesai,
        ];

        // 5 pengaduan terbaru
        $recent_complaints = Complaint::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'total_menunggu',
            'total_diproses',
            'total_selesai',
            'total_all',
            'monthly_data',
            'monthly_labels',
            'status_data',
            'recent_complaints'
        ));
    }
}
