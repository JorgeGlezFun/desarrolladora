<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use Illuminate\Http\Request;
use App\Models\Videojuego;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $desarrolladoras = Desarrolladora::all();
        return view('videojuegos.index', ["videojuegos"=>Videojuego::all(), 'desarrolladoras' => $desarrolladoras]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desarrolladoras = Desarrolladora::all();

        return view('videojuegos.create', compact('desarrolladoras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Videojuego::create([
            'titulo' => $request->titulo,
            'anyo' => $request->anyo,
            'desarrolladora_id' => $request->desarrolladora_id
        ]);
        return redirect()->route("videojuegos.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        return view('videojuegos.show', ['videojuego' => $videojuego]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        $desarrolladoras = Desarrolladora::all();

        return view('videojuegos.edit', ['videojuego' => $videojuego, 'desarrolladoras' => $desarrolladoras]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $videojuego->update([
            "titulo" =>$request->titulo,
            "anyo" => $request->anyo,
            "desarrolladora_id" => $request->desarrolladora_id
        ]);
        return redirect()->route("videojuegos.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        Videojuego::destroy([$videojuego->id]);
        return redirect()->route("videojuegos.index");
    }
}
