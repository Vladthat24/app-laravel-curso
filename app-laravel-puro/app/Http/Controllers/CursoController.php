<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCurso;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('id', 'desc')->paginate();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }
    public function store(StoreCurso $request)
    {
        /*     OPCION N°1 */
        /*        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->categoria = $request->categoria;

        $curso->save(); */

        /* OPCION N°2 */
        /*         $curso= Curso::create([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'categoria'=>$request->categoria
        ]); */

        /* OPCION N°3 - AGREGA TODOS LOS CAMPOS*/
        $curso = Curso::create($request->all());

        return redirect()->route('cursos.show', $curso->id);
    }
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);

        /*         $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->categoria = $request->categoria;
        $curso->save(); */

        $curso->update($request->all());

        return redirect()->route('cursos.show', $curso->id);
    }
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
