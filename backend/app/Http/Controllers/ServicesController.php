<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $services = Services::all();
     return response()->json($services);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $request->validate ([
            'name' => 'required',
        ]);

        $services = Services::create($data);    

        return response()->json($services, 201);

    }

    public function delete($id)
    {
        $services = Services::findOrFail($id);
        $services->delete();

        return response()->json(['message' => 'Serviço deletado com sucesso']);    
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
    public function show(Request $request)
    {
        $services = Services::FindOrFail($request->id);
        return response()->json($services);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $services = services::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        if ($services->update($data)) {
            return response()->json(["message" => "success"], 200);
        }

        return response()->json(["message" => "error"], 500);
    }

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