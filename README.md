# TesteEmpresta
Teste Contratação

Relatório:

	Aplicação desenvolvida em ambiente Windows

	Install via XAMPP 7.4.8

	Check extensions (requisitos Laravel):
		C:\xampp\php\php.ini

	Install Composer:
		https://getcomposer.org/download/

	Install Laravel
		CMD: composer global require laravel/installer

	Criação Pasta do Projeto
		mkdir TesteEmprestaBemMelhor

	Criação do Project
		laravel new apiRest

	Run project
		php artisan serve

	Criação de controllers e Models para realização da Prova
		php artisan make:controller api\ConvenioController
			Desenvolvido método de busca da lista de Convênios, retornando um JSON
			Possível listar todos os itens ou apenas o solicitado

		php artisan make:controller api\InstituicaoController
			Desenvolvido método de busca da lista de Instituição, retornando um JSON
			Possível listar todos os itens ou apenas o solicitado

		php artisan make:controller api\EmprestimoController
			Realiza cálculo para simulação de emprestimo
				Valida a obrigatoriedade e o tipo do valor de empréstimo solicitado,
				os demais campos permite inserir vários valores para fitragem de dados, sendo necessário a separação por vírgula

		php artisan make:model Model\EmprestimoModel
			Como se tratavam se poucos dados escolhi não implementar a leitura dos arquivos, disponibilizando as informações diretamente no model.


	Ajuste de Rotas
		routes/api.php

	Ajuste de validação de Dados
		Expection/Hnadler.php


	Todos os testes foram realizados via Postman.
	A Collection do mesmo se encontra em anexo.
