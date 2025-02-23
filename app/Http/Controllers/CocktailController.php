<?php
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
        // Obtiene los cócteles almacenados desde la base de datos
        $cocktails = Cocktail::all();

        // Pasar los cócteles a la vista
        return view('cocktails.stored-cocktails', compact('cocktails'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'alcoholic' => 'required|string|max:255',
            'image' => 'required|url',
        ]);

        // Crear un nuevo cóctel en la base de datos
        try {
            Cocktail::create([
                'name' => $request->name,
                'category' => $request->category,
                'alcoholic' => $request->alcoholic,
                'image' => $request->image,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Redirigir a la lista de cócteles almacenados con un mensaje de éxito
        return redirect()->route('cocktails.stored')->with('success', 'Cóctel guardado exitosamente.');
    }

    public function destroy(Cocktail $cocktail)
    {
        // Eliminar el cóctel de la base de datos
        $cocktail->delete();

        // Redirigir a la lista de cócteles almacenados con un mensaje de éxito
        return redirect()->route('cocktails.stored')->with('success', 'Cóctel eliminado exitosamente.');
    }
}