<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Resources\RoomResource;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = Room::all();
        // return response()->json($order);
        return RoomResource::collection(Room::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'room_number' => ['required'],
            'room_description' => ['required'],
            'room_status_id' => ['required']
        ]);

        $room = Room::create([
            'room_number' => $request->room_number,
            'room_description' => $request->room_description,
            'room_status_id' => $request->room_status_id
        ]);
        return response()->json($room);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condition = Room::where('id', $id)->first();
        if (!$condition) {
            return response() -> json(['message' => 'Product not found.' ]);
        } else {
            return response()->json(Room::findOrFail($id));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $condition = Room::where('id', $id)->first();
        if (!$condition) {
            return response()->json(['message' => 'Room not found' ]);
        } else {
            $rooms = Room::findOrFail($id);
            $rooms->update($request->all());
            return response()->json($rooms);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condition = Room::where('id', $id)->first();
        if (!$condition) {
            return response() -> json([ 'message' => 'Room not found' ]);
        } else {
            Room::find($id)->delete($id);
            return response()->json(['message' => 'Room deleted']);
        }
    }

    public function restore($id)
    {
        $condition = Room::onlyTrashed()->where('id', $id)->first();
        if (!$condition) {
            return response() -> json([ 'message' => 'Room not found' ]);
        } else {
            Room::onlyTrashed()->find($id)->restore();
            return response()->json([ 'message' => 'Room restored' ]);
        }
    }
}
