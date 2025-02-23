@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/list-cocktails.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Lista de cocteles por letra</h1>
            <div class="mb-3">
                <!-- Botones de paginación por letra -->
                <div class="button-group" role="group" aria-label="Alphabet Pagination">
                    @foreach(range('A', 'Z') as $letter)
                        <button type="button" class="btn btn-secondary load-cocktails" data-letter="{{ $letter }}">{{ $letter }}</button>
                    @endforeach
                </div>
            </div>
            <div id="cocktail-carousel" class="splide cocktail-carousel" style="max-height: 400px;">
                <div class="splide__track">
                    <ul class="splide__list" id="cocktail-list">
                        <!-- Los cócteles se cargarán aquí mediante jQuery -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inicializa Splide
        var splide = new Splide('#cocktail-carousel', {
            "container": "#fixedWidth",
            "fixedWidth": 300,
            "swipeAngle": false,
            "speed": 400
        }).mount();

        // Función para cargar cócteles por letra
        function loadCocktails(letter) {
            $.ajax({
                url: `https://www.thecocktaildb.com/api/json/v1/1/search.php?f=${letter}`,
                method: 'GET',
                success: function(data) {
                    $('#cocktail-list').empty();
                    if (data.drinks) {
                        data.drinks.forEach(function(drink) {
                            $('#cocktail-list').append(`
                                <li class="splide__slide">
                                    <div class="card" style="width: 18rem;" data-name="${drink.strDrink}" data-category="${drink.strCategory}" data-alcoholic="${drink.strAlcoholic}" data-image="${drink.strDrinkThumb}">
                                        <img src="${drink.strDrinkThumb}" class="card-img-top" alt="${drink.strDrink}">
                                        <div class="card-body">
                                            <h5 class="card-title">${drink.strDrink}</h5>
                                            <p class="card-text">Category: ${drink.strCategory}</p>
                                            <p class="card-text">Alcoholic: ${drink.strAlcoholic}</p>
                                            <button class="btn btn-secondary save-cocktail">Guardar</button>
                                        </div>
                                    </div>
                                </li>
                            `);
                        });
                        splide.refresh();
                    } else {
                        $('#cocktail-list').append('<li class="splide__slide">No cocktails found.</li>');
                    }
                }
            });
        }

        // Carga cócteles por la letra 'A' al inicio
        loadCocktails('A');

        // Evento para cargar cócteles por letra
        $(document).on('click', '.load-cocktails', function() {
            var letter = $(this).data('letter');
            loadCocktails(letter);
        });

        // Evento para guardar cóctel en la base de datos
        $(document).on('click', '.save-cocktail', function() {
            var card = $(this).closest('.card');
            var drink = {
                strDrink: card.data('name'),
                strCategory: card.data('category'),
                strAlcoholic: card.data('alcoholic'),
                strDrinkThumb: card.data('image')
            };

            $.ajax({
                url: '{{ route("cocktails.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: drink.strDrink,
                    category: drink.strCategory,
                    alcoholic: drink.strAlcoholic,
                    image: drink.strDrinkThumb
                },
                success: function(response) {
                    alert('Cóctel guardado exitosamente.');
                },
                error: function(xhr) {
                    alert('Error al guardar el cóctel.');
                }
            });
        });
    });
</script>
@endsection