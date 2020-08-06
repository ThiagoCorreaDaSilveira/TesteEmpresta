<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmprestimoModel;

class ConvenioController extends Controller
{
    public function convenios(Request $request)
    {
        // Variável utilizada na filtragem dos dados
        $chave = $request->input("chave");

        // Obtem lista de Convenios
        $data = new EmprestimoModel;
        $search = $data->getConvenios($chave); 
        
        return $search;
    }
}
