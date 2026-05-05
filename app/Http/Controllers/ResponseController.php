<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'response' => 'required|string|max:2000',
        ]);

        Response::create([
            'complaint_id' => $complaint->id,
            'user_id'      => Auth::id(),
            'response'     => $request->response,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }
}
