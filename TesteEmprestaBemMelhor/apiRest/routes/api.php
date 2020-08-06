<?php

//Route::apiResource('convenio', 'api\ConvenioController');
//Route::apiResource('instituicao', 'api\InstituicaoController');


// Padrão do Framework
Route::get('convenios', 'api\ConvenioController@convenios');
Route::get('instituicoes', 'api\InstituicaoController@instituicoes');
Route::post('simular', 'api\EmprestimoController@calcular');