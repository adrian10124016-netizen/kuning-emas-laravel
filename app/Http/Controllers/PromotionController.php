<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderByDesc('id')->get();

        return view('promotions.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:40', 'alpha_dash', 'unique:promotions,code'],
            'discount_percent' => ['required', 'integer', 'min:1', 'max:90'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Promotion::create([
            'title' => $validated['title'],
            'code' => strtoupper($validated['code']),
            'discount_percent' => $validated['discount_percent'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('promotions.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'code' => [
                'required',
                'string',
                'max:40',
                'alpha_dash',
                Rule::unique('promotions', 'code')->ignore($promotion->id),
            ],
            'discount_percent' => ['required', 'integer', 'min:1', 'max:90'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $promotion->update([
            'title' => $validated['title'],
            'code' => strtoupper($validated['code']),
            'discount_percent' => $validated['discount_percent'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('promotions.index')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function toggle(Promotion $promotion)
    {
        $promotion->update([
            'is_active' => ! $promotion->is_active,
        ]);

        return redirect()->route('promotions.index')
            ->with('success', 'Status promo berhasil diubah.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')
            ->with('success', 'Promo berhasil dihapus.');
    }
}