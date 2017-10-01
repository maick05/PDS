<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddExcursaoController extends CI_Controller 
{
	public function criar_excursao()	  //Cadastra o usuario
	{
		$excursao = $this->input->post("excursoes");
		$excursao['id_criador'] = $this->session->userdata('usuario_logado')['id_usuario'];
		$this->ExcursoesModel->inserirExcursao($excursao);

		$dados = array('excursao' => $this->ExcursoesModel->retornarUltimaExcursao());
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
