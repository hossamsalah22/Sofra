<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Contact::where(
            function ($q) use ($request) {
                if ($request->input('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                }
                if ($request->input('email')) {
                    $q->where('email', 'like', '%' . $request->email . '%');
                }
                if ($request->input('phone')) {
                    $q->where('phone', 'like', '%' . $request->phone . '%');
                }
            }
        )->latest()->get();
        return view('contactus.index', compact('model'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Contact::findOrFail($id);
        return view('contactus.show', compact('model'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Contact::findOrFail($id);
        $model->delete();
        flash('deleted')->success();
        return back();
    }
}
