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

	public function ver_detalhes_excursao($id)
	{
		$status = $this->InscricoesModel->verificarInscricao($this->session->userdata('usuario_logado')['id_usuario'], $id);
		$excursao = $this->ExcursoesModel->verDetalhesExcursao($id);
		if (!$status) 
		{
			if($excursao['id_criador'] == $this->session->userdata('usuario_logado')['id_usuario'])
			{
				$status['status'] = "criador";
				$status['id_inscricao'] = null;
				$status['pagseguro'] = null;
			}
			else
			{
				$status['status'] = "não inscrito";
				$status['id_inscricao'] = null;
				$status['pagseguro'] = null;
			}
		}

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'insc_pagseguro' => $status['pagseguro']);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
