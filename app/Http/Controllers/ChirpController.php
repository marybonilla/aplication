<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view ('chirps.index');
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar mensaje

        $request -> validate([
            'message' => ['required' , 'min:4' , 'max:255' ],

        ]);


        //inset into database
        Chirp :: create ([
            'message' => $request->get ('message'),
            'user_id' => auth () -> id(),

        ]);
        session()-> flash('status', __('Chirp Created Successfully!'));
        return redirect()->route('chirps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
