<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:received,checking,for_signature,signed,released,archived',
            'remarks' => 'nullable|string|max:1000',
        ];
    }
}
