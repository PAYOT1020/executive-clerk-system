<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCategoryRequest;
use App\Models\DocumentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DocumentCategoryController extends Controller
{
    public function index(): View
    {
        $categories = DocumentCategory::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(DocumentCategoryRequest $request): RedirectResponse
    {
        DocumentCategory::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }
}
