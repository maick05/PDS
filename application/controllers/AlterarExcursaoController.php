<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlterarExcursaoController extends CI_Controller 
{
	public function editar_excursao()	  //Cadastra o usuario
	{
		$excursao = $this->input->post("excursao");
		$this->ExcursoesModel->editarExcursao($excursao);

		$this->ver_detalhes_excursao($excursao['id_excursao']);
	}

	public function ver_detalhes_excursao($id)
	{
		$excursao = $this->ExcursoesModel->verDetalhesExcursao($id);
		$status['status'] = "criador";
		$status['id_inscricao'] = null;
		$status['pagseguro'] = null;

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'insc_pagseguro' => $status['pagseguro'], 'msg_exc' => 'Excursão alterada com sucesso!');
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
