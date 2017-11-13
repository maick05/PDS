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

		$rota = $this->PontosParadaModel->retornarPontos($id);
		$media = $this->AvaliacoesModel->retornarMedia($excursao['id_criador']);
		$minha_av = $this->AvaliacoesModel->retornarAvaliacao($this->session->userdata('usuario_logado')['id_usuario'], $excursao['id_criador']);

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'insc_pagseguro' => $status['pagseguro'], 'msg_exc' => 'Excursão alterada com sucesso!', 'rota' => $rota,'minha_av' => $minha_av, 'media' => $media);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
