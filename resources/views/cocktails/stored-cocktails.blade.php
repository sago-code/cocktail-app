@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/stored-cocktails.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Cócteles Almacenados</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Alcohólico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Programador</td>
                        <td>404</td>
                        <td>quien yo?</td>
                        <td>
                            <form method="POST">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @foreach($cocktails as $cocktail)
                    <tr>
                        <td>{{ $cocktail->name }}</td>
                        <td>{{ $cocktail->category }}</td>
                        <td>{{ $cocktail->alcoholic }}</td>
                        <td>
                            <form action="{{ route('cocktails.destroy', $cocktail) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
