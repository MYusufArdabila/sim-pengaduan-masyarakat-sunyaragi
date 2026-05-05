<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'warga') {
            $complaints = Complaint::where('user_id', $user->id)
                ->with('category')
                ->latest()
                ->get();
        } else {
            $complaints = Complaint::with(['category', 'user'])
                ->latest()
                ->get();
        }

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $categories = ComplaintCategory::all();
        return view('complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:complaint_categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:500',
            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            'photo'       => 'nullable|image|max:2048',
        ]);

        $data                = $request->only(['category_id', 'title', 'description', 'location', 'latitude', 'longitude']);
        $data['user_id']     = Auth::id();
        $data['status']      = 'Menunggu';

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('complaints/photos', 'public');
        }

        Complaint::create($data);

        return redirect()->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dikirim. Kami akan segera menindaklanjuti.');
    }

    public function show(Complaint $complaint)
    {
        if (Auth::user()->role === 'warga' && $complaint->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        $complaint->load(['user', 'category', 'responses.user']);
        return view('complaints.show', compact('complaint'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        $complaint->update(['status' => $request->status]);

        return back()->with('success', 'Status pengaduan berhasil diubah menjadi "' . $request->status . '".');
    }

    public function uploadFile(Request $request, Complaint $complaint)
    {
        $request->validate([
            'finished_file' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png,doc,docx',
        ]);

        // Hapus file lama jika ada
        if ($complaint->finished_file) {
            Storage::disk('public')->delete($complaint->finished_file);
        }

        $path = $request->file('finished_file')->store('complaints/files', 'public');
        $complaint->update([
            'finished_file' => $path,
            'status'        => 'Selesai',
        ]);

        return back()->with('success', 'File dokumen berhasil diunggah dan status diubah ke Selesai.');
    }
}
