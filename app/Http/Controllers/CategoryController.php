<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    try {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'date_range' => 'nullable|string|regex:/^\d{4}-\d{2}-\d{2}\s-\s\d{4}-\d{2}-\d{2}$/'
        ]);

        if ($validator->fails()) {
            // Jika validasi gagal, hapus parameter yang bermasalah
            $request->offsetUnset('date_range');
        }

        $query = Category::query();

        // Filter berdasarkan nama (case-insensitive)
        if ($request->filled('name')) {
            $query->where('name', 'ilike', "%{$request->name}%");
        }

        // Filter berdasarkan rentang tanggal
        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->date_range);
            
            if (count($dates) === 2) {
                // Pastikan tanggal valid dengan Carbon
                try {
                    $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dates[0]);
                    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dates[1])->endOfDay();
                    
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                } catch (\Exception $e) {
                    // Jika format tanggal tidak valid, hapus filter date_range
                    $request->offsetUnset('date_range');
                }
            }
        }

        // Tambahkan sorting
        $query->orderByDesc('created_at');

        // Paginasi dengan mempertahankan query string
        $categories = $query->simplePaginate(10)->appends(
            $request->only(['name', 'date_range'])
        );

        return view('categories.index', compact('categories'));

    } catch (\Exception $e) {
        // Log error untuk debugging
        \Log::error('Category Index Error: ' . $e->getMessage());
        
        // Redirect dengan pesan error umum
        return redirect()->route('categories.index')
            ->with('error', 'Terjadi kesalahan saat memuat data kategori');
    }
}

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories', 'max:255'],
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name,'.$category->id, 'max:255'],
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
