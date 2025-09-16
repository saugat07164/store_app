<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories.index', [
            'items' => $categories,
            'title' => 'Categories',
            'resourceName' => 'categories'
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'title' => 'Create Category',
            'resourceName' => 'categories'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', [
            'item' => $category,
            'title' => 'Edit Category',
            'resourceName' => 'categories'
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
