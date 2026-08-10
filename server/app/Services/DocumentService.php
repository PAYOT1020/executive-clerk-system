<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Document;
use App\Models\DocumentAssignment;
use App\Models\DocumentFile;
use App\Models\DocumentStatusHistory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    public function store(array $data, ?UploadedFile $file = null): Document
    {
        return DB::transaction(function () use ($data, $file) {

            $trackingNumber = $this->generateTrackingNumber();

            $document = Document::create([
                'tracking_number' => $trackingNumber,
                'category_id' => $data['category_id'],
                'subject' => $data['subject'],
                'sender' => $data['sender'],
                'date_received' => $data['date_received'],
                'current_status' => 'received',
                'lifecycle_status' => 'active',
                'received_by' => Auth::id(),
                'assigned_to' => $data['assigned_to'] ?? null,
                'remarks' => $data['remarks'] ?? null,
            ]);

            if ($file) {
                $this->attachFile($document, $file);
            }

            DocumentStatusHistory::create([
                'document_id' => $document->id,
                'status' => 'received',
                'remarks' => 'Document received.',
                'updated_by' => Auth::id(),
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Created Document',
                'module' => 'Documents',
                'record_id' => $document->id,
                'description' => 'Received document: ' . $trackingNumber,
                'ip_address' => request()->ip(),
            ]);

            return $document;
        });
    }

    public function updateStatus(Document $document, array $data): Document
    {
        return DB::transaction(function () use ($document, $data) {

            $document->update([
                'current_status' => $data['status'],
                'remarks' => $data['remarks'] ?? $document->remarks,
            ]);

            // Terminal statuses close the document out of the active queue
            if (in_array($data['status'], ['released', 'archived'], true)) {
                $document->update([
                    'lifecycle_status' => $data['status'] === 'archived' ? 'archived' : 'completed',
                ]);
            }

            DocumentStatusHistory::create([
                'document_id' => $document->id,
                'status' => $data['status'],
                'remarks' => $data['remarks'] ?? null,
                'updated_by' => Auth::id(),
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Updated Status',
                'module' => 'Documents',
                'record_id' => $document->id,
                'description' => 'Changed status to ' . str_replace('_', ' ', $data['status']),
                'ip_address' => request()->ip(),
            ]);

            return $document->fresh();
        });
    }

    public function assignDocument(Document $document, array $data): Document
    {
        return DB::transaction(function () use ($document, $data) {

            DocumentAssignment::create([
                'document_id' => $document->id,
                'assigned_by' => Auth::id(),
                'assigned_to' => $data['assigned_to'],
                'remarks' => $data['remarks'] ?? null,
            ]);

            $document->update([
                'assigned_to' => $data['assigned_to'],
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Assigned Document',
                'module' => 'Documents',
                'record_id' => $document->id,
                'description' => 'Assigned document to user ID ' . $data['assigned_to'],
                'ip_address' => request()->ip(),
            ]);

            return $document->fresh();
        });
    }

    private function attachFile(Document $document, UploadedFile $file): void
    {
        $storedName = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('documents', $storedName, 'public');

        DocumentFile::create([
            'document_id' => $document->id,
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'uploaded_by' => Auth::id(),
        ]);
    }

    private function generateTrackingNumber(): string
    {
        // lockForUpdate() only matters inside a transaction, which store()
        // already wraps this call in — prevents duplicate tracking numbers
        // if two clerks submit at nearly the same time.
        $year = date('Y');

        $count = Document::where('tracking_number', 'like', "ECS-{$year}-%")
            ->lockForUpdate()
            ->count();

        return 'ECS-' . $year . '-' . str_pad($count + 1, 6, '0', STR_PAD_LEFT);
    }
}
