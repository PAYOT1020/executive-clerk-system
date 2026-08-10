<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}
