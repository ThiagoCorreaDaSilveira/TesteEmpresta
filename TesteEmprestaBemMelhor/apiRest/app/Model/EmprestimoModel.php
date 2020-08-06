<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EmprestimoModel extends Model
{
    private $_convenios = '[
        {
            "chave": "INSS",
            "valor": "INSS"
        },
        {
            "chave": "FEDERAL",
            "valor": "Federal"
        },
        {
            "chave": "SIAPE",
            "valor": "Siape"
        }
    ]';

    private $_instituicoes = '[
        {
            "chave": "PAN",
            "valor": "Pan"
        },
        {
            "chave": "OLE",
            "valor": "Ole"
        },
        {
            "chave": "BMG",
            "valor": "Bmg"
        }
    ]';

    private $_taxas = '[
        {
            "parcelas": 72,
            "taxaJuros": 2.05,
            "coeficiente": 0.02604,
            "instituicao": "BMG",
            "convenio": "INSS"
        },
        {
            "parcelas": 60,
            "taxaJuros": 2.05,
            "coeficiente": 0.03015,
            "instituicao": "BMG",
            "convenio": "INSS"
        },
        {
            "parcelas": 48,
            "taxaJuros": 2.05,
            "coeficiente": 0.03529,
            "instituicao": "BMG",
            "convenio": "INSS"
        },
        {
            "parcelas": 36,
            "taxaJuros": 2.05,
            "coeficiente": 0.04719,
            "instituicao": "BMG",
            "convenio": "INSS"
        },
        {
            "parcelas": 84,
            "taxaJuros": 1.9,
            "coeficiente": 0.024384,
            "instituicao": "BMG",
            "convenio": "INSS"
        },
        {
            "parcelas": 48,
            "taxaJuros": 2.05,
            "coeficiente": 0.03429,
            "instituicao": "PAN",
            "convenio": "INSS"
        },
        {
            "parcelas": 72,
            "taxaJuros": 2.08,
            "coeficiente": 0.02843,
            "instituicao": "PAN",
            "convenio": "INSS"
        },
        {
            "parcelas": 36,
            "taxaJuros": 2.10,
            "coeficiente": 0.03125,
            "instituicao": "PAN",
            "convenio": "FEDERAL"
        },
        {
            "parcelas": 60,
            "taxaJuros": 2.05,
            "coeficiente": 0.03035,
            "instituicao": "OLE",
            "convenio": "INSS"
        },
        {
            "parcelas": 72,
            "taxaJuros": 2.08,
            "coeficiente": 0.02843,
            "instituicao": "OLE",
            "convenio": "INSS"
        }
    ]';

    public $rules = [
        'valor_emprestimo' => 'required|numeric',
        //'instituicoes' = '',
        //'convenios' = '',
        //'parcela' = ''
    ];

    private function getGenerico($data, $chave)
    {
        if(isset($chave))
            foreach ($data as $rec)
            {
                if ($rec["chave"] == $chave)
                    return json_encode($rec);
            }
        else
            return $data;
    }

    public function getConvenios($chave = null)
    {
        $data = json_decode($this->_convenios, true);
        return $this->getGenerico($data, $chave);
    }

    public function getInstituicoes($chave = null)
    {
        $data = json_decode($this->_instituicoes, true);
        return $this->getGenerico($data, $chave);
    }

    public function getEmprestimo($req)
    {

        $data = json_decode($this->_taxas, true);

        $emprestimo = array();

        // Loop em Instituições
        foreach (json_decode($this->_instituicoes, true) as $instituicao) 
            
            // Verifica uma ou todas as instituições 
            //(De acordo com as opções de filtro do usuário)
            if(in_array($instituicao['chave'], $req['instituicoes']) OR empty($req['instituicoes'][0])) 
                
                // Loop em Taxas
                foreach (json_decode($this->_taxas, true) as $taxa)
                    
                    // Garante incremento de celulas apenas de sua respectiva instituição
                    if($taxa["instituicao"] == $instituicao["chave"]) 
                        
                        // Verifica uma ou todos os convenios 
                        //(De acordo com as opções de filtro do usuário)
                        if(in_array($taxa["convenio"], $req['convenios']) OR empty($req['convenios'][0]))
                            
                            // Verifica uma ou todos as opções de parcela 
                            //(De acordo com as opções de filtro do usuário)
                            if(in_array($taxa["parcelas"], $req['parcela'])  OR empty($req['parcela'][0]))
                            {
                                // Insere dados calculado para simulacao do emprestimo

                                $emprestimo[$instituicao["chave"]][] = array(
                                    "taxa" => $taxa["taxaJuros"],
                                    "parcelas" => $taxa["parcelas"],
                                    "valor_parcela" => round($req['valor_emprestimo'] * $taxa["coeficiente"], 2),
                                    "convenio" => $taxa["convenio"]
                                ); 
                            }


        return json_encode($emprestimo, true);
    }
}
