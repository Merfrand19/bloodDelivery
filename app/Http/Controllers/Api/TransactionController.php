<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['sender', 'receiver'])->get();
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:hospitals,id',
            'receiver_id' => 'required|exists:hospitals,id',
            'transaction_date' => 'required|date',
            'sending_time' => 'date_format:H:i:s',
            'reception_time' => 'date_format:H:i:s',
            'status'=>"string|max:255"
        ]);

        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction->load(['sender', 'receiver']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'sender_id' => 'sometimes|required|exists:hospitals,id',
            'receiver_id' => 'sometimes|required|exists:hospitals,id',
            'transaction_date' => 'sometimes|required|date',
            'sending_time' => 'sometimes|required|date_format:H:i:s',
            'reception_time' => 'sometimes|nullable|date_format:H:i:s',
            'status' => 'sometimes|required|string|max:255',
        ]);

        $transaction->update($request->only([
            'sender_id',
            'receiver_id',
            'transaction_date',
            'sending_time',
            'reception_time',
            'status',
        ]));

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(['message' => 'Transaction supprimée']);
    }
}
