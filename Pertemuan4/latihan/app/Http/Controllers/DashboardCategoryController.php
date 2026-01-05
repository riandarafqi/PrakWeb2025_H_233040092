<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardCategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    // Form Tambah
    public function create()
    {
        return view('dashboard.categories.create');
    }

    // Simpan Data (Hanya Name)
    public function store(Request $request)
    {
        // Validasi sesuai modul (Name wajib & unik)
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Simpan langsung (tanpa slug)
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    // Update Data
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Hapus Data
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}