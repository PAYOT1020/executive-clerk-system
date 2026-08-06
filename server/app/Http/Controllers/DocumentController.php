<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\User;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    protected DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index()
    {
        $documents = Document::with('category', 'assignedTo')
            ->latest()
            ->paginate(10);

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $categories = DocumentCategory::where('is_active', true)->get();

        $executiveClerks = User::where('role', 'executive_clerk')->get();

        return view('documents.create', compact('categories', 'executiveClerks'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $this->documentService->store($request->validated());

        return redirect()
            ->route('documents.index')
            ->with('success', 'Document received successfully.');
    }
}
