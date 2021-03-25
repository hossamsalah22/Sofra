<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Order::where(
            function ($q) use ($request) {
                if ($request->input('id')) {
                    $q->where('id', $request->id);
                }
                if ($request->input('resturant_id')) {
                    $q->where('resturant_id', $request->resturant_id);
                }
            }
        )->get();
        return view('orders.index', compact('model'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Order::findOrFail($id);
        return view('orders.show', compact('model'));
    }

    /**
     * Print the specified Order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printOrder($id)
    {
        $model = Order::findOrFail($id);
        return view('orders.print', compact('model'));
    }
}
