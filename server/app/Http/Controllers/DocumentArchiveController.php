<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;

class DocumentArchiveController extends Controller
{
    public function index()
    {
        $search = request('search');
        $status = request('status');
        $categoryId = request('category_id');

        $documents = Document::with(['category', 'assignedTo', 'receivedBy'])
            ->where('lifecycle_status', '!=', 'active') // only completed/archived docs
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tracking_number', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%")
                      ->orWhere('sender', 'like', "%{$search}%");
                });
            })
            ->when($status, fn ($query) => $query->where('current_status', $status))
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = DocumentCategory::where('is_active', true)->get();

        return view('archive.index', compact('documents', 'categories'));
    }
}
