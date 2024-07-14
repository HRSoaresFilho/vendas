<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Protege as rotas com autenticação
    }

    public function store(Request $request)
    {
        // Validar os dados
        $request->validate([
            'sale_date' => 'required|date',
            'sale_product' => 'required|integer',
            'sale_value' => 'required|numeric',
            'sale_lat' => 'required|numeric',
            'sale_lon' => 'required|numeric',
        ]);

        // Salvar registro na tabela Local
        $local = Local::create([
            'lon' => $request->sale_lon,
            'lat' => $request->sale_lat,
        ]);

        // Salvar registro na tabela Venda
        $venda = Venda::create([
            'produto_id' => $request->sale_product,
            'local_id' => $local->id,
            'preco' => $request->sale_value,
            'titulo_permissao_id' => 3,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'venda' => $venda], 201);
    }
}
