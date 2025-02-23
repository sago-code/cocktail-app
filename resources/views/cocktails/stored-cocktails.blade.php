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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Alcohólico</th>
                        <th colspan="2"  class="center-th">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cocktails as $cocktail)
                    <tr>
                        <td>
                            <img src="{{ $cocktail->image }}" alt="Imagen coctel">
                        </td>
                        <td>{{ $cocktail->name }}</td>
                        <td>{{ $cocktail->category }}</td>
                        <td>{{ $cocktail->alcoholic }}</td>
                        
                        <td class="center-td">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#contnt-edit{{ $cocktail->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </button>
                        </td>
                        <td class="center-td">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#contnt-delete{{ $cocktail->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    
                    <div id="contnt-edit{{ $cocktail->id }}" class="contnt-edit modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <h1>Actualizar cóctel</h1>
                                    <div class="mb-3">
                                        <input type="file" id="fileInput" accept="image/*" value ="{{ $cocktail->image }}" onchange="mostrarPrevia(this)"/>
                                        <img alt="Vista previa" src="{{ $cocktail->image }}" class="VistaImg">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" placeholder="name@example.com" name="name" value="{{ $cocktail->name }}" />
                                        <label for="name" class="form-label">Nombre</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="category" placeholder="name@example.com" name="category" value="{{ $cocktail->category }}" />
                                        <label for="category" class="form-label">Categoría</label>
                                    </div>
                                    <div class="form-floating">
                                        <select class="form-select" id="alcoholic" aria-label="Floating label select example">
                                            @if ($cocktail->name == 'Alcoholic')
                                                <option selected disabled value="Alcoholic">Con alcohol</option>
                                            @else
                                                <option selected disabled value="Non alcoholic">Sin alcohol</option>
                                            @endif
                                            <option value="Alcoholic">Con alcohol</option>
                                            <option value="Non alcoholic">Sin alcohol</option>
                                        </select>
                                        <label class="form-check-label" for="alcoholic">
                                            Alcohólico
                                        </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="contnt-delete{{ $cocktail->id }}" class="contnt-delete modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Advertencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Esta seguro que desea eliminar el Coctel "{{ $cocktail->name }}"</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('cocktails.destroy', $cocktail) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function mostrarPrevia(input) {
            const file = input.files[0]; // Obtiene el archivo seleccionado
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Encuentra la imagen dentro del mismo div contenedor
                    const img = input.parentNode.querySelector("img"); 
                    img.src = e.target.result;
                    img.style.display = "block"; // Muestra la imagen
                }
                reader.readAsDataURL(file); // Convierte el archivo a base64
            }
        }
    </script>
</div>
@endsection
