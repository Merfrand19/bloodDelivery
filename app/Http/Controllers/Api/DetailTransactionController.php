<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;

class DetailTransactionController extends Controller
{
    //
    public function index()
    {
        $detailTransactions = DetailTransaction::with(['transaction', 'bloodType'])->get();
        return response()->json($detailTransactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'blood_quantity' => 'required|integer|min:1',
        ]);

        $detailTransaction = DetailTransaction::create($request->all());
        return response()->json($detailTransaction, 201);
    }

    public function show(DetailTransaction $detailTransaction)
    {
        return response()->json($detailTransaction->load(['transaction', 'bloodType']));
    }

    public function update(Request $request, DetailTransaction $detailTransaction)
    {
        $request->validate([
            'transaction_id' => 'sometimes|required|exists:transactions,id',
            'blood_type_id' => 'sometimes|required|exists:blood_types,id',
            'blood_quantity' => 'sometimes|required|integer|min:1',
        ]);

        $detailTransaction->update($request->only([
            'transaction_id',
            'blood_type_id',
            'blood_quantity',
        ]));

        return response()->json($detailTransaction);
    }

    public function destroy(DetailTransaction $detailTransaction)
    {
        $detailTransaction->delete();
        return response()->json(['message' => 'DetailTransaction deleted']);
    }
}
