<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalDocuments = Document::count();

        $pendingDocuments = Document::whereNotIn('current_status', [
            'released',
        ])->count();

        $releasedDocuments = Document::where(
            'current_status',
            'released'
        )->count();

        $recentDocuments = Document::with([
            'category',
            'assignedTo',
        ])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDocuments',
            'pendingDocuments',
            'releasedDocuments',
            'recentDocuments'
        ));
    }
}
