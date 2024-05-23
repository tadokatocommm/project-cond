<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Reserves;


class ReservesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reserves = Reserves::all();
        return response()->json($reserves);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = auth()->user(); 
    
        $data = $request->validate([
            'data' => 'required|string',
            'id_service' => 'required|integer',
        ]);
    
        $data['id_user'] = $user->id; 
    
        $reserves = Reserves::create($data);    
    
        return response()->json($reserves, 201);
    }
    

    public function delete($id)
    {
        $reserves = Reserves::findOrFail($id);
        $reserves->delete();

        return response()->json(['message' => 'Reserva deletada com sucesso']);    
    }

    public function show(Request $request)
    {
        $reserves = Reserves::FindOrFail($request->id);
        return response()->json($reserves);
    }

    public function edit(Request $request, $id)
    {
        $reserves = Reserves::findOrFail($id);

        $data = $request->validate([
            'data' => 'required|string',
            'id_service' => 'required|integer',
        ]);

        if ($reserves->update($data)) {
            return response()->json(["message" => "success"], 200);
        }

        return response()->json(["message" => "error"], 500);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
