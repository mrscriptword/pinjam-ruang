<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;

class DaftarRuangController extends Controller
{
    public function index()
    {
        return view('daftarruang', [
            'title' => "Daftar Ruang",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(6),
            'allRooms' => Room::orderBy('code', 'asc')->get(), // Added this line to get all rooms for the dropdown
            'buildings' => Building::all(),
        ]);
    }

    public function searchRooms(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([
                'rooms' => Room::orderBy('created_at', 'desc')->paginate(6)->items(),
                'count' => Room::count()
            ]);
        }

        $rooms = Room::where('name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhere('capacity', 'like', "%{$query}%")
            ->with('building')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'rooms' => $rooms,
            'count' => $rooms->count()
        ]);
    }

    public function show(Room $room)
    {

        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->latest()->paginate(5),
        ]);
    }
}
