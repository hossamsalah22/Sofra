<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Client::where(
            function ($q) use ($request) {
                if ($request->input('neighbourhood_id')) {
                    $q->where('neighbourhood_id', $request->neighbourhood_id);
                }
                if($request->input('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                }
            }
        )->get();
        return view('clients.index', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Client::findOrFail($id);
        $model->delete();
        flash('Deleted')->success();
        return back();
    }

    public function activate($id)
    {
        $client = Client::findOrFail($id);
        $client->activated = 1;
        $client->save();
        flash('Activated')->success();
        return back();
    }

    public function deActivate($id)
    {
        $client = Client::findOrFail($id);
        $client->activated = 0;
        $client->save();
        flash('De-Activated')->success();
        return back();
    }
}
