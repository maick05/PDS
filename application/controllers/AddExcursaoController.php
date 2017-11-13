<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddExcursaoController extends CI_Controller 
{
	public function criar_excursao()	  //Cadastra o usuario
	{
		$excursao = $this->input->post("excursoes");
		$excursao['id_criador'] = $this->session->userdata('usuario_logado')['id_usuario'];
		$this->ExcursoesModel->inserirExcursao($excursao);

		$this->ver_detalhes_excursao($this->db->insert_id());
	}

	public function ver_detalhes_excursao($id)
	{
		$excursao = $this->ExcursoesModel->verDetalhesExcursao($id);
		$status['status'] = "criador";
		$status['id_inscricao'] = null;
		$status['pagseguro'] = null;

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'insc_pagseguro' => $status['pagseguro'], 'novo' => true, 'msg_exc' => 'Excursão criada com sucesso!', 'rota' => null, 'media' => 0, 'minha_av' => null);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
