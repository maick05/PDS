<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddExcursaoController extends CI_Controller 
{
	public function criar_excursao()	  //Cadastra o usuario
	{
		$excursao = $this->input->post("excursoes");
		$this->ExcursoesModel->inserirExcursao($excursao);
	}
}
