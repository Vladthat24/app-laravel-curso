@extends('layouts.plantilla')

@section('title','Cursos')
@section('content')
<h2>Bienvenidos a la pagina principal</h2>
<a href="{{route('cursos.create')}}">Crear Curso</a>
<br>
<ul>
    @foreach($cursos as $curso)
        <li>
            <a href="{{route('cursos.show',$curso)}}">{{$curso->nombre}}</a>
            <br>
            {{route('cursos.show',$curso)}}
        </li>
    @endforeach
</ul>
{{$cursos->links()}}
@endsection

