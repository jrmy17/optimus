<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use App\Http\Requests\CompteRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comptes = Compte::where('id_admin', Auth::id())->get();
        return view('compte/index', compact('comptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compte/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompteRequest $request, Compte $compte)
    {
        $compte->intitule = $request->intitule;
        $compte->id_admin = $request = Auth::id();
        $compte->save();
        return redirect()
            ->route('compte.index')
            ->with('info', 'Le compte ' . $compte->intitule . ' a été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_compte)
    {
        require __DIR__.'../../../Support/Solde.php';
        $compte = Compte::where('id', $id_compte)->firstOrFail();

        $transactions = Transaction::where('id_compte', $compte->id)->get();
        $solde = getSolde($transactions);
        return view('compte/dashboard', compact('compte', 'transactions', 'solde'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_compte)

    {
        $compte = Compte::where('id', $id_compte)->firstOrFail();
        return view('compte/edit', compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompteRequest $request, $id_compte)
    {
        $compte = Compte::where('id', $id_compte)->firstOrFail();
        $compte->update($request->all());
        return redirect()->route('compte.dashboard', $id_compte)->with('info', 'Les informations du compte ont bien été modifiés');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_compte)
    {
        Compte::find($id_compte)->delete();
    
        return redirect()
            ->route('compte.index')
            ->with('info', 'Le compte a bien été suprimé');
    }
}
