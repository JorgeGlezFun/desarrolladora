<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use Illuminate\Http\Request;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'desarrolladoras.nombre'); // Crea una query para ordenar por el nombre de la desarrolladora
        $order_dir = $request->query('order_dir', 'asc'); // Crea una query para ordenar de forma ascendente
        // Realiza la consulta, con la tabla Videojuego, juntándola con Desarrolladora y esta a su vez con distribuidora
        $videojuegos = Auth::user()->videojuegos()->with(['desarrolladora', 'desarrolladora.distribuidora'])
        /*
        Auth::user()->videojuegos()->with(['desarrolladora', 'desarrolladora.distribuidora']) Esto lo que hace es que segun el usuario loguedo
        con Auth::user() sacas el objeto de dicho usuario, le pasas el metodo videojuegos() que hemos creado para la relacion (esta en el modelo User)
        with(['desarrolladora', 'desarrolladora.distribuidora']) carga las relaciones desarrolladora y distribuidora de la relación desarrolladora del modelo principal.
        */

        // Hacemos un join de la tabla "desarrolladoras" a través del id en videojuegos
        ->join('desarrolladoras', 'videojuegos.desarrolladora_id', '=', 'desarrolladoras.id')
        ->join('distribuidoras', 'desarrolladoras.distribuidora_id', '=', 'distribuidoras.id')
        ->orderBy($order, $order_dir) // Ordena por los parametros pasados
        ->orderBy('distribuidoras.nombre', $order_dir) // Ordena también por el nombre de la distribuidora
        ->orderBy('videojuegos.titulo') // Ordena por título (si es necesario)
        ->get(); // Recoge y devuelve la consulta

        /*
        Si queremos hacer una paginacion, prescindimos del get y usamos ->paginate(n)
        en la paginacion hay que usar un {{ $resultados->links() }} para realizar la paginacion
        en este caso $resultados es $videojuegos
        */
        return view('videojuegos.index', [
            'videojuegos'=>$videojuegos,
            'order'=>$order,
            'order_dir'=>$order_dir,
        ]);
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
        return redirect()->route('videojuegos.index');
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

        // Importamos "use Illuminate\Support\Facades\Gate;" en nuestro controlador para poder hacer uso del Gate::allows
        // esto funciona de manera que revisa si el usuario esta autorizado para realizar la accion (lo mira en VideojuegoPolicies)
        // Una vez lo confirma, procede con el ability (la accion que queremos que verifique, en este caso update), y mira si puede
        // realizarla en el modelo objeto que en este caso es Videojuego, si cumple con ello, entra al edit, si no cumple, devuelve al index.

        if (Gate::allows('update', $videojuego)) {
            return view('videojuegos.edit', ['videojuego' => $videojuego, 'desarrolladoras' => $desarrolladoras]);
        } else {
            return redirect()->route('videojuegos.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $videojuego->update([
            'titulo' =>$request->titulo,
            'anyo' => $request->anyo,
            'desarrolladora_id' => $request->desarrolladora_id
        ]);
        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        Videojuego::destroy([$videojuego->id]);
        return redirect()->route('videojuegos.index');
    }
}
