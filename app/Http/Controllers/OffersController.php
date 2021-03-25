<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Offer::where(
            function ($q) use ($request) {
                if ($request->input('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                    if (request()->input('resturant_id')) {
                        $q->where('resturant_id', request()->resturant_id);
                    }
                } elseif (request()->input('resturant_id')) {
                    $q->where('resturant_id', request()->resturant_id);
                }
            }
        )->latest()->get();
        return view('offers.index', compact('model'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Offer::findOrFail($id);
        return view('offers.show', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Offer::findOrFail($id);
        $model->delete();
        flash('Deleted')->success();
        return back();
    }
}
