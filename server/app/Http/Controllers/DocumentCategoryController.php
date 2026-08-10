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

    public function edit(DocumentCategory $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(DocumentCategoryRequest $request, DocumentCategory $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(DocumentCategory $category): RedirectResponse
    {
        // Guard: don't allow deleting a category that already has documents attached
        if ($category->documents()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete a category that has documents linked to it.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
