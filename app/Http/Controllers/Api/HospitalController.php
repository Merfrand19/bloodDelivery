<?php

namespace App\Http\Controllers\Api;

use App\Models\Hospital;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::with(['departement', 'type'])->get();

        // Retourner la réponse JSON avec tous les hôpitaux
        return response()->json([
            'success' => true,
            'message' => 'Liste des hôpitaux',
            'hospitals' => $hospitals,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'adresse' => ['required', 'string', 'max:255'],
            'departement_id' => ['required', 'exists:departements,id'],
            'type_id' => ['required', 'exists:hospital_types,id'],
            'hasBloodBank' => ['required', 'boolean'],
        ]);
        
        $hospital = Hospital::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'departement_id' => $request->departement_id,
            'type_id' => $request->type_id,
            'hasBloodBank' => $request->hasBloodBank,
        ]);

        //$hospital = $hospital->load(['departement', 'type']);

        // Retourner la réponse JSON avec l'hôpital créé
        return response()->json( $hospital, 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        $hospital = $hospital->load(['departement', 'type']);
        return response()->json(['hospital' => $hospital], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'nom' => ['string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'adresse' => ['string', 'max:255'],
            'departement_id' => ['exists:departements,id'],
            'type_id' => ['exists:hospital_types,id'],
            'hasBloodBank' => ['boolean'],
        ]);

        $hospital->update($request->only([
            'nom', 
            'adresse', 
            'departement_id', 
            'type_id', 
            'hasBloodBank'
        ]));

        $hospital = $hospital->load(['departement', 'type']);

        return response()->json([
            'success' => true,
            'message' => 'Hopital mis à jour avec succès',
            'hospital' => $hospital,
        ], 200);
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return response()->json([
            'message' => 'Hopital supprimé'
        ], 204);

    }
}
