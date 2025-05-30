<?php

namespace App\Http\Controllers;

use App\Models\PartneringOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartneringOrderController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum');// currently, all methods are protected by 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $part_ord = PartneringOrder::all(); 

        if (!$part_ord){
            return response()->json([
            'message' => 'no partnering orders found'
        ], 404);
        } else
        return response()->json([
            'message' => 'partnering orders found',
            'data' => $part_ord // Return the products in JSON format
        ], 200);
    }

    

    /**
     * Display the specified resource.
     */
    public function show(PartneringOrder $partneringOrder)
    {
        if (!$partneringOrder){
            return response()->json([
            'message' => 'partnering order not found'
        ], 404);
        } else
        return response()->json([
            'message' => 'partnering order found',
            'data' => $partneringOrder // Return the products in JSON format
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartneringOrder $partneringOrder)
    {
        $val = $request->validate([
            'status' => ['required',
                Rule::in(['Waiting','Accepted', 'Rejected'])]
        ]);

        $partneringOrder->update($val);

        if ($partneringOrder->status == 'Rejected'){
            $store = $partneringOrder->store;
            $store->is_active = false;
            $store->save();
        } 
        else if ($partneringOrder->status == 'Accepted'){
            $store = $partneringOrder->store;
            $store->is_active = true;
            $store->save();
        }


        return response()->json([
            'message' => 'partner order updated successfully',
            'data' => $partneringOrder,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(PartneringOrder $partneringOrder)
    // {
    //     $partneringOrder->delete();

    //     return response()->json([ // Return a JSON response indicating success
    //         'message' => 'partner order Deleted Successfully'
    //     ]);
    // }
}
