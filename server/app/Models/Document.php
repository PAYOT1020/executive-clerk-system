<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DocumentCategory;
use App\Models\User;
use App\Models\DocumentFile;
use App\Models\DocumentStatusHistory;
use App\Models\DocumentAssignment;

class Document extends Model
{
    protected $fillable = [
        'tracking_number',
        'category_id',
        'subject',
        'sender',
        'date_received',
        'current_status',
        'lifecycle_status',
        'received_by',
        'assigned_to',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'date_received' => 'date',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function files(): HasMany
    {
        return $this->hasMany(DocumentFile::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(DocumentStatusHistory::class);
    }

    public function assignments()
    {
        return $this->hasMany(DocumentAssignment::class);
    }
}
