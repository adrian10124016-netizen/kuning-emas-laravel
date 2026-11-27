<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function showcase(Request $request)
    {
        $selectedCategory = $request->query('category');
        $search = trim((string) $request->query('search', ''));

        $categories = Category::orderBy('name')->pluck('name');

        $query = Menu::with('category')
            ->where('is_available', true)
            ->orderBy('id');

        if (!empty($selectedCategory)) {
            $query->where(function ($q) use ($selectedCategory) {
                $q->where('category', $selectedCategory)
                    ->orWhereHas('category', function ($sub) use ($selectedCategory) {
                        $sub->where('name', $selectedCategory);
                    });
            });
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        $menus = $query->get();

        return view('welcome', compact('menus', 'categories', 'selectedCategory', 'search'));
    }

    public function show(Menu $menu)
    {
        $menu->load('category');

        return view('menus.show', compact('menu'));
    }

    public function index()
    {
        $menus = Menu::with('category')->orderByDesc('id')->get();
        $categories = Category::orderBy('name')->get();

        return view('menus.index', compact('menus', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'category_id' => $category->id,
            'category' => $category->name,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available', true),
        ]);

        return redirect()->route('menus.index')
            ->with('success', 'Menu baru berhasil ditambahkan dan terhubung ke kategori.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::orderBy('name')->get();

        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            if (!empty($menu->image) && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'category_id' => $category->id,
            'category' => $category->name,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available', false),
        ]);

        return redirect()->route('menus.index')
            ->with('success', 'Data menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if (!empty($menu->image) && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    public function toggleAvailability(Menu $menu)
    {
        $menu->update([
            'is_available' => ! $menu->is_available,
        ]);

        return redirect()->route('menus.index')
            ->with('success', 'Status ketersediaan menu diperbarui.');
    }
}