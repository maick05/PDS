<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BuscarExcursoesController extends CI_Controller 
{
	public function pesquisar_excursoes()	  //Cadastra o usuario
	{
		$nome = $this->input->post("nome");
		$dados = array('excursoes' => $this->ExcursoesModel->pesquisarExcursoes($nome));
		$this->load->template('excursoes/buscar_excursoes', '', $dados);
	}
}
