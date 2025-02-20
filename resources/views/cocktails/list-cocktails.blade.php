@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Lista de cocteles por letra</h1>
            <div id="cocktail-carousel" class="splide">
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
        // Inicializar Splide
        new Splide('#cocktail-carousel', {
            type   : 'loop',
            perPage: 3,
            perMove: 1,
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
                                    <div class="card" style="width: 18rem;">
                                        <img src="${drink.strDrinkThumb}" class="card-img-top" alt="${drink.strDrink}">
                                        <div class="card-body">
                                            <h5 class="card-title">${drink.strDrink}</h5>
                                            <p class="card-text">Category: ${drink.strCategory}</p>
                                            <p class="card-text">Alcoholic: ${drink.strAlcoholic}</p>
                                            <button class="btn btn-primary save-cocktail" data-drink='${JSON.stringify(drink)}'>Guardar</button>
                                        </div>
                                    </div>
                                </li>
                            `);
                        });
                    } else {
                        $('#cocktail-list').append('<li class="splide__slide">No cocktails found.</li>');
                    }
                }
            });
        }

        // Cargar cócteles por la letra 'a' al inicio
        loadCocktails('a');

        // Evento para guardar cóctel en la base de datos
        $(document).on('click', '.save-cocktail', function() {
            var drink = $(this).data('drink');
            $.ajax({
                url: '{{ route("cocktails.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    drink: drink
                },
                success: function(response) {
                    alert('Cóctel guardado exitosamente.');
                }
            });
        });
    });
</script>
@endsection