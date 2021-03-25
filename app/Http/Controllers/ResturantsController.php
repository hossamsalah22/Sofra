<?php

namespace App\Http\Controllers;

use App\Models\Resturant;
use Illuminate\Http\Request;

class ResturantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Resturant::where(
            function ($q) use ($request) {
                if ($request->input('neighbourhood_id')) {
                    $q->where('neighbourhood_id', $request->neighbourhood_id);
                }
                if ($request->input('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                }
            }
        )->get();
        return view('resturants.index', compact('model'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Resturant::findOrFail($id);
        return view('resturants.show', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Resturant::findOrFail($id);
        $model->delete();
        flash('Deleted')->success();
        return back();
    }

    public function activate($id)
    {
        $restaurant = Resturant::findOrFail($id);
        $restaurant->activated = 1;
        $restaurant->save();
        flash('Activated')->success();
        return back();
    }

    public function deActivate($id)
    {
        $restaurant = Resturant::findOrFail($id);
        $restaurant->activated = 0;
        $restaurant->save();
        flash('De-Activated')->success();
        return back();
    }
}
