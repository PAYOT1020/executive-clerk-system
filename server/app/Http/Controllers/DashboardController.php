<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'totalDocuments' => Document::count(),

'pendingDocuments' => Document::where('current_status', 'received')->count(),

'forSignature' => Document::where('current_status', 'for_signature')->count(),

'releasedDocuments' => Document::where('current_status', 'released')->count(),
        ]);
    }
}
