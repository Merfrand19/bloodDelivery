<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodInventory;

class BloodInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bloodInventories = BloodInventory::with(['bloodType', 'hospital'])->get();
        return response()->json($bloodInventories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'blood_type_id' => 'required|exists:blood_types,id',
            'hospital_id' => 'required|exists:hospitals,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $bloodInventory = BloodInventory::create($request->all());
        return response()->json($bloodInventory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodInventory $bloodInventory)
    {
        return response()->json($bloodInventory->load(['bloodType', 'hospital']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BloodInventory $bloodInventory)
    {

        $validatedData = $request->validate([
            'blood_type_id' => 'sometimes|required|exists:blood_types,id',
            'hospital_id' => 'sometimes|required|exists:hospitals,id',
            'quantity' => 'sometimes|required|integer|min:0',
        ]);

        $bloodInventory->update($request->only(['blood_type_id', 'hospital_id', 'quantity']));
        return response()->json($bloodInventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodInventory $bloodInventory)
    {
        $bloodInventory->delete();
        return response()->json(['message' => 'Inventaire supprimé avec succès']);
    }
}
