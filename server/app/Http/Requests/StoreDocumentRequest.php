<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:document_categories,id',
            'subject' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'date_received' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
            'remarks' => 'nullable|string|max:1000',
            'document_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB
        ];
    }
}
