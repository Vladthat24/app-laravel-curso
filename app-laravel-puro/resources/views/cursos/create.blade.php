@extends('layouts.plantilla')

@section('title','Cursos Create')
@section('content')

<h4>En esta pagina podras crear un curso - HOLA VLAD. TE SALUDA TU PAPA</h4>


<form action="{{route('cursos.store')}}" method="POST">
    @csrf

    <label for="">Nombre: <br><input type="text" name="nombre" value="{{old('nombre')}}"></label>
    @error('nombre')
    <br>
        <small>*{{$message}}</small>
    <br>
    @enderror
    <br>
    <label for="">Descripcion: <br><textarea name="descripcion" cols="30" rows="10">{{old('descripcion')}}</textarea></label>
    @error('descripcion')
    <br>
        <small>*{{$message}}</small>
    <br>
    @enderror
    <br>
    <label for="">Categoria: <br><input type="text" name="categoria" value="{{old('categoria')}}"></label>
    @error('categoria')
    <br>
        <small>*{{$message}}</small>
    <br>
    @enderror
    <br>
    <button type="submit">Enviar formulario</button>
</form>
@endsection


