<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        $total_all      = Complaint::count();
        $total_menunggu = Complaint::where('status', 'Menunggu')->count();
        $total_diproses = Complaint::where('status', 'Diproses')->count();
        $total_selesai  = Complaint::where('status', 'Selesai')->count();

        // Grafik 12 bulan terakhir
        $months = collect(range(11, 0))->map(fn($i) => Carbon::now()->subMonths($i)->format('Y-m'));

        $monthly_labels = $months->map(
            fn($m) => Carbon::createFromFormat('Y-m', $m)->locale('id')->isoFormat('MMM YY')
        );

        $monthly_menunggu = $months->map(
            fn($m) => Complaint::whereYear('created_at', substr($m, 0, 4))
                ->whereMonth('created_at', substr($m, 5, 2))
                ->where('status', 'Menunggu')->count()
        );

        $monthly_diproses = $months->map(
            fn($m) => Complaint::whereYear('created_at', substr($m, 0, 4))
                ->whereMonth('created_at', substr($m, 5, 2))
                ->where('status', 'Diproses')->count()
        );

        $monthly_selesai = $months->map(
            fn($m) => Complaint::whereYear('created_at', substr($m, 0, 4))
                ->whereMonth('created_at', substr($m, 5, 2))
                ->where('status', 'Selesai')->count()
        );

        $monthly_total = $months->map(
            fn($m) => Complaint::whereYear('created_at', substr($m, 0, 4))
                ->whereMonth('created_at', substr($m, 5, 2))
                ->count()
        );

        // Tabel rekapitulasi per bulan
        $rekap = $months->map(function ($m) {
            $label    = Carbon::createFromFormat('Y-m', $m)->locale('id')->isoFormat('MMMM YYYY');
            $menunggu = Complaint::whereYear('created_at', substr($m, 0, 4))->whereMonth('created_at', substr($m, 5, 2))->where('status', 'Menunggu')->count();
            $diproses = Complaint::whereYear('created_at', substr($m, 0, 4))->whereMonth('created_at', substr($m, 5, 2))->where('status', 'Diproses')->count();
            $selesai  = Complaint::whereYear('created_at', substr($m, 0, 4))->whereMonth('created_at', substr($m, 5, 2))->where('status', 'Selesai')->count();
            $total    = $menunggu + $diproses + $selesai;
            return compact('label', 'menunggu', 'diproses', 'selesai', 'total');
        });

        return view('statistik.index', compact(
            'total_all', 'total_menunggu', 'total_diproses', 'total_selesai',
            'monthly_labels', 'monthly_total',
            'monthly_menunggu', 'monthly_diproses', 'monthly_selesai',
            'rekap'
        ));
    }
}
