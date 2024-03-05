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
       return view ('chirps.index', [
        'chirps' => Chirp:: with('user') ->latest()-> get()
       ]);
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

         // Crear un chirp asociado al usuario actual
         $request->user()->chirps()->create([
        'message' => $request->input('message'),
    ]);


        //inset into database
        // Chirp :: create ([
        //     'message' => $request->get ('message'),
        //     'user_id' => auth () -> id(),

        // ]);
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
        $this->authorize('update', $chirp);

        // if (auth ()-> user()->isNot($chirp->user)){
        //     abort(403);
        // }
        return view ('chirps.edit', [
            'chirp' =>$chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $this->authorize('update', $chirp);

        // if (auth ()-> user()->isNot($chirp->user)){
        //     abort(403);
        // }

        $validated = $request -> validate([
            'message' => ['required' , 'min:4' , 'max:255' ],

        ]);
        $chirp->update($validated);

        return to_route('chirps.index') ->with ('status', __('Chirp updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp ->delete();

        return to_route('chirps.index') ->with ('status', __('Chirp deleted successfully!'));

    }
}
