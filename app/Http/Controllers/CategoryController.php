<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {

        if (request('search') ?? false) {
            request()->validate([
                'search' => ['bail', 'exists:categories,slug']
            ]);
            return redirect("categories/" . request('search') . "/edit");
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['bail', 'required', 'unique:categories,name'],
            'slug' => ['bail', 'required', 'unique:categories,slug'],
        ]);

        Category::create($attributes);

        return back()->with('success', 'Category added successfully.');

    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update( Request $request, Category $category)
    {

        $attributes = $request->validate([
            'name' => ['bail', 'required', 'unique:categories,name,' . $category->id],
            'slug' => ['bail', 'required', 'unique:categories,slug,' . $category->id],
        ]);

        $category->update($attributes);

        return back()->with('success', 'Category updated successfully.');

    }

}
