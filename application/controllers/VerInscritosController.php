<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerInscritosController extends CI_Controller 
{
	public function confirmar_inscricao()	  //Cadastra o usuario
	{
		$id = $this->input->post("id_inscricao");
		$id_exc = $this->input->post("id_excursao");
		$this->InscricoesModel->atualizarStatus("confirmada", $id);
		$this->ver_inscritos($id, $id_exc, "Inscrição confirmada com sucesso!");
	}

	public function cancelar_inscricao()	  //Cadastra o usuario
	{
		$id = $this->input->post("id_inscricao");
		$id_exc = $this->input->post("id_excursao");
		$this->InscricoesModel->atualizarStatus("pendente", $id);
		$this->ver_inscritos($id, $id_exc, "A inscrição foi alterada para pendente!");
	}

	public function ver_inscritos($id, $id_exc, $msg)
	{
		$dados = array('inscritos' => $this->InscricoesModel->verInscritosExcursao($id_exc), 'msg' => $msg);
		$this->load->template('excursoes/ver_inscritos', '', $dados);
	}

	// public function ver_detalhes_excursao($id, $msg)
	// {
	// 	$status = $this->InscricoesModel->verificarInscricao($this->session->userdata('usuario_logado')['id_usuario'], $id);
	// 	$excursao = $this->ExcursoesModel->verDetalhesExcursao($id);
	// 	if (!$status) 
	// 	{
	// 		if($excursao['id_criador'] == $this->session->userdata('usuario_logado')['id_usuario'])
	// 		{
	// 			$status['status'] = "criador";
	// 			$status['id_inscricao'] = null;
	// 			$status['pagseguro'] = null;
	// 		}
	// 		else
	// 		{
	// 			$status['status'] = "não inscrito";
	// 			$status['id_inscricao'] = null;
	// 			$status['pagseguro'] = null;
	// 		}
	// 	}

	// 	$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'msg' => $msg, 'insc_pagseguro' => $status['pagseguro']);
	// 	$this->load->template('excursoes/detalhes_excursao', '', $dados);
	// }
}
