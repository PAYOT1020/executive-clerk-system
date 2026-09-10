<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Requests\UpdateDocumentStatusRequest;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\User;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $documentService
    ) {}

    public function index()
    {
        $documents = Document::with(['category', 'assignedTo'])
            ->when(request('search'), function ($query) {
                $search = request('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tracking_number', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%")
                      ->orWhere('sender', 'like', "%{$search}%");
                });
            })
            ->when(request('status'), fn ($query) => $query->where('current_status', request('status')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

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
        $document = $this->documentService->store(
            $request->validated(),
            $request->file('document_file')
        );

        return redirect()
            ->route('documents.show', $document)
            ->with('success', 'Document received successfully.');
    }

    public function show(Document $document)
    {
        $document->load([
            'category',
            'assignedTo',
            'receivedBy',
            'files',
            'statusHistories.updatedBy',
        ]);

        $executiveClerks = User::where('role', 'executive_clerk')
            ->where('id', '!=', auth()->id())
            ->get();

        return view('documents.show', compact('document', 'executiveClerks'));
    }

    public function edit(Document $document)
    {
        $categories = DocumentCategory::where('is_active', true)->get();

        return view('documents.edit', compact('document', 'categories'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->validated());

        return redirect()
            ->route('documents.show', $document)
            ->with('success', 'Document details updated successfully.');
    }

    public function updateStatus(UpdateDocumentStatusRequest $request, Document $document)
    {
        $this->documentService->updateStatus($document, $request->validated());

        return redirect()
            ->route('documents.show', $document)
            ->with('success', 'Document status updated successfully.');
    }

    public function destroy(Document $document)
    {
        //
    }
        public function assignForm(Document $document)
        {
            $executiveClerks = User::where('role', 'executive_clerk')
                ->where('id', '!=', auth()->id())
                ->get();

            return view('documents.assign', compact('document', 'executiveClerks'));
        }

    public function assign(AssignDocumentRequest $request, Document $document)
    {
        $this->documentService->assignDocument($document, $request->validated());

        return redirect()
            ->route('documents.show', $document)
            ->with('success', 'Document assigned successfully.');
    }
}
