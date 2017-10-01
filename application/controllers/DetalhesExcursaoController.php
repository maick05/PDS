<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalhesExcursaoController extends CI_Controller 
{
	public function inscrever_se()	  //Cadastra o usuario
	{
		$inscricao = $this->input->post("inscricoes");
		$this->InscricoesModel->inserirInscricao($inscricao);
		$this->ver_detalhes_excursao($inscricao['id_excursao'], "Inscrição realizada com sucesso!");
	}

	public function cancelar_inscricao()
	{
		$inscricao = $this->input->post("inscricoes");
		$this->InscricoesModel->deletarInscricao($inscricao['id_inscricao']);
		$this->ver_detalhes_excursao($inscricao['id_excursao'], "Sua inscrição foi cancelada com sucesso!");
	}

	public function confirmar_inscricao()
	{
		
	}

	public function ver_detalhes_excursao($id, $msg)
	{
		$status = $this->InscricoesModel->verificarInscricao($this->session->userdata('usuario_logado')['id_usuario'], $id);
		if (!$status) 
		{
			$status['status'] = "não inscrito";
			$status['id_inscricao'] = null;
		}

		$dados = array('excursao' => $this->ExcursoesModel->verDetalhesExcursao($id), 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'msg' => $msg);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
