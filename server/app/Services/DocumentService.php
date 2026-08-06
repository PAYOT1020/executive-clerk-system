<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Document;
use App\Models\DocumentStatusHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            // Generate tracking number
            $trackingNumber = $this->generateTrackingNumber();

            // Save document
            $document = Document::create([
                'tracking_number' => $trackingNumber,
                'category_id' => $data['category_id'],
                'subject' => $data['subject'],
                'sender' => $data['sender'],
                'date_received' => $data['date_received'],
                'current_status' => 'received',
                'lifecycle_status' => 'active',
                'received_by' => Auth::id(),
                'assigned_to' => $data['assigned_to'],
                'remarks' => $data['remarks'] ?? null,
            ]);

            // Save status history
            DocumentStatusHistory::create([
                'document_id' => $document->id,
                'status' => 'received',
                'remarks' => 'Document received.',
                'updated_by' => Auth::id(),
            ]);

            // Save activity log
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

    private function generateTrackingNumber(): string
    {
        $count = Document::count() + 1;

        return 'ECS-' . date('Y') . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);
    }
}
