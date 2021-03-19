<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighbourhoodRequest;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;

class NeighbourhoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Neighbourhood::all();
        return view('neighbourhoods.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('neighbourhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NeighbourhoodRequest $request)
    {
        $model = Neighbourhood::create($request->all());
        flash('success')->success();
        return redirect(route('neighbourhood.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Neighbourhood::findOrFail($id);
        return view('neighbourhoods.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Neighbourhood::findOrFail($id);
        return view('neighbourhoods.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NeighbourhoodRequest $request, $id)
    {
        $model = Neighbourhood::findOrFail($id);
        $model->update($request->all());
        flash('updated')->success();
        return redirect(route('neighbourhood.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Neighbourhood::findOrFail($id);
        $model->delete();
        flash('Deleted')->success();
        return back();
    }
}
