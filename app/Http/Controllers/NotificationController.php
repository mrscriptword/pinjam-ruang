<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark a notification as read and redirect to daftarpinjam page
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($id)
    {
        // Find the rent by ID
        $rent = Rent::findOrFail($id);
        
        // Check if the current user owns this rent record
        if ($rent->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses pemberitahuan ini.');
        }
        
        // Mark notification as read
        $rent->update(['read_status' => true]);
        
        // Redirect to daftarpinjam page
        return redirect('/daftarpinjam')->with('success', 'Pemberitahuan telah ditandai sebagai dibaca.');
    }
}
