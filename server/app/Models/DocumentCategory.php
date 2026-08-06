<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'description',
    'is_active'
])]
class DocumentCategory extends Model
{
    public function documents(): HasMany
{
    return $this->hasMany(Document::class, 'category_id');
}
}
