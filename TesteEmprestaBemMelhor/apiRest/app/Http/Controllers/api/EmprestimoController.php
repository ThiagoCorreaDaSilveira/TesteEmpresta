<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmprestimoModel;

class EmprestimoController extends Controller
{
    public function calcular(Request $request)
    {
        $req['valor_emprestimo'] = $request->input("valor_emprestimo");

        /* --Tratamentos--
            Converte string em array (explode)
            remove espaço str_replace
            strtoupper (pois todas as chaves são por default Upper Case)
        */
        $req['instituicoes'] = explode(',', strtoupper(str_replace(' ', '', $request->input("instituicoes"))));
        $req['convenios'] = explode(',', strtoupper(str_replace(' ', '', $request->input("convenios"))));
        $req['parcela'] = explode(',', strtoupper(str_replace(' ', '', $request->input("parcela"))));

        $data = new EmprestimoModel;
        
        // Valida parâmetro antes de Executar a Simulação
        $this->validate($request, $data->rules);

        // Processa Simulação
        $search = $data->getEmprestimo($req);
        
        return $search;
    }
}
