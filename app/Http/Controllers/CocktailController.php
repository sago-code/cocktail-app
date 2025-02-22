<?php
// filepath: /c:/Users/orjue/OneDrive/Documentos/Santiago/cocktail-app/app/Http/Controllers/CocktailController.php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cocktail;

class CocktailController extends Controller
{
    public function list()
    {
        // Lógica para mostrar la lista de cocteles
        return view('cocktails.list-cocktails');
    }

    public function stored()
    {
        // Obtener los cócteles almacenados desde la base de datos
        $cocktails = Cocktail::all();

        // Pasar los cócteles a la vista
        return view('cocktails.stored-cocktails', compact('cocktails'));
    }
}