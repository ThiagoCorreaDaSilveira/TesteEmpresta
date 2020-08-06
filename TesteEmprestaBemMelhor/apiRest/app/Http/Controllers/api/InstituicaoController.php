<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmprestimoModel;

class InstituicaoController extends Controller
{
    public function instituicoes(Request $request)
    {
        // Variável utilizada na filtragem dos dados
        $chave = $request->input("chave");

        // Obtem lista de Instituições
        $data = new EmprestimoModel;
        $search = $data->getInstituicoes($chave);
        
        return $search;
    }

}
