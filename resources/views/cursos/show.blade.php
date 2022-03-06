@extends('layouts.plantilla')

@section('title','Cursos',$curso->nombre)
@section('content')


<h2>Bienvenido al curso {{$curso->nombre}}</h2>
<a href="{{route('cursos.index')}}">Volver</a><br>
<a href="{{route('cursos.edit',$curso)}}">Editar Curso</a>
<p><strong>Categoria: </strong>{{$curso->categoria}}</p>
<p><strong>Descripcion: </strong>{{$curso->descripcion}}</p>

<form action="{{route('cursos.destroy',$curso)}}" method="POST">
    @method('delete')
    @csrf
    <button type="submit">Eliminar</button>
</form>
@endsection

