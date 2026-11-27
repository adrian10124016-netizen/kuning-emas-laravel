<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatus = $request->query('status', 'Semua');
        $search = $request->query('search');

        $reservations = Reservation::query()
            ->when($selectedStatus && $selectedStatus !== 'Semua', function ($query) use ($selectedStatus) {
                $query->where('status', $selectedStatus);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('guest_name', 'like', "%{$search}%")
                        ->orWhere('guest_phone', 'like', "%{$search}%")
                        ->orWhere('seating_time', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('reservation_date')
            ->latest('id')
            ->get();

        return view('reservations.index', compact('reservations', 'selectedStatus', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_phone' => ['required', 'string', 'max:30'],
            'reservation_date' => ['required', 'date'],
            'seating_time' => ['required', 'string', 'max:100'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:30'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['status'] = 'Pending';

        Reservation::create($validated);

        return redirect()->to(url('/') . '#reservasi')
            ->with('reservation_success', 'Reservasi meja Anda telah diterima. Tim KUNING EMAS akan segera mengonfirmasi jadwal Anda.');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Pending,Dikonfirmasi,Selesai,Dibatalkan'],
        ]);

        $reservation->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->back()->with('success', 'Data reservasi berhasil dihapus.');
    }
}