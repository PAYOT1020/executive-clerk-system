<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
{
    $totalDocuments = Document::count();

    $receivedDocuments = Document::where('current_status', 'received')->count();

    $forSignatureDocuments = Document::where('current_status', 'for_signature')->count();

    $releasedDocuments = Document::where('current_status', 'released')->count();

    $checkingDocuments = Document::where('current_status', 'checking')->count();

    return view('dashboard.index', compact(
        'totalDocuments',
        'receivedDocuments',
        'checkingDocuments',
        'forSignatureDocuments',
        'releasedDocuments'
    ));
}
}
