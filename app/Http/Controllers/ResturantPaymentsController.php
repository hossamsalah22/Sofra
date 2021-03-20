<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResturantPaymentsRequest;
use App\Models\Commission;
use Illuminate\Http\Request;

class ResturantPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Commission::where(
            function ($q) use ($request) {
                if ($request->input('resturant_id')) {
                    $q->where('resturant_id', $request->resturant_id);
                }
                if ($request->input('payment_date')) {
                    $q->where('payment_date', 'like', '%' . $request->payment_date . '%');
                }
            }
        )->latest()->get();
        return view('resturantPayments.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resturantPayments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResturantPaymentsRequest $request)
    {
        $model = Commission::create($request->all());
        flash('Success')->success();
        return redirect(route('resturants-payments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Commission::findOrFail($id);
        return view('resturantPayments.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResturantPaymentsRequest $request, $id)
    {
        $model = Commission::findOrFail($id);
        $model->update($request->all());
        flash('updated')->success();
        return redirect(route('resturants-payments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Commission::findOrFail($id);
        $model->delete();
        flash('Deleted')->success();
        return back();
    }
}
