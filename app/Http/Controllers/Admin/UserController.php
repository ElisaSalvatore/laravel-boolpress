<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InfoUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route("admin.users.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Per evitare che ci stiano delle rotte che puntino a funzioni inesistenti (errore 500)
        return redirect()->route("admin.users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("admin.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            "name" => "required|min:2",
            // Nell' "unique" specifico in quale tabella si trova e in quale colonna.
            // Per far sì che la mail sia unica concateno l'"id" in modo tale che 
            // durante la ricerca per vedere se l'email è già in uso tra gli altri utenti registrati
            // ma ignora l'id dell'utente che si sta analizzando.
            "email" => "required|email|unique:users,email," . $id,
            "phone" => "nullable",
            "address" => "nullable",
            "avatar" => "nullable",
        ]);

        $user->update($data);

          // Creiamo le infoUser se queste non esistono ancora
        if (!$user->infoUser) {
            $infoUser = new InfoUser();
            $infoUser->fill($data);
            
            $user->infoUser()->save($infoUser);
        } else {
            // se invece esistono già, le si aggiornano
            $user->infoUser->fill($data);
            $user->infoUser->save();
        }

        return redirect()->route("admin.users.show", $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
