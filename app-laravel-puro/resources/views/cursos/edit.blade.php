@extends('layouts.plantilla')

@section('title','Cursos Edit')
@section('content')

<h4>En esta pagina podras editar un curso</h4>


<form action="{{route('cursos.update',$curso)}}" method="POST">
    @csrf
    @method('put')

    <label for="">Nombre: <br>
        <input type="text" name="nombre" value="{{old('nombre',$curso->nombre)}}">

        @error('nombre')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror
    </label>
        <br>
    <label for="">Descripcion: <br>
        <textarea name="descripcion" cols="30" rows="10">{{old('descripcion',$curso->descripcion)}}</textarea>
    </label>
        <br>
        @error('descripcion')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror
    <label for="">Categoria: <br>
        <input type="text" name="categoria" value="{{old('categoria',$curso->categoria)}}">
    </label>
        <br>
        @error('categoria')
        <br>
        <small>*{{$message}}</small>
        <br>
    @enderror
        <br>
    <button type="submit">Actualizar formulario</button>
</form>
@endsection
