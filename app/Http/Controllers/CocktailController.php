<?php
// filepath: /c:/Users/orjue/OneDrive/Documentos/Santiago/cocktail-app/app/Http/Controllers/CocktailController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocktailController extends Controller
{
    public function list()
    {
        // Lógica para mostrar la lista de cocteles
        return view('cocktails.list-cocktails');
    }

    public function stored()
    {
        // Lógica para mostrar los cocteles almacenados
        return view('cocktails.stored-cocktails');
    }
}