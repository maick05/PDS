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

	// public function confirmar_inscricao()
	// {
		
	// }

	public function verificar_autorizacao()
	{
		$id = $this->session->userdata('usuario_logado')['id_usuario'];
		$aut = $this->AutorizacoesModel->verificarAutorizacao($id);
		if ($aut) 
		{
			echo $aut['email'];
		}
	}

	public function manter_autorizacao()
	{
		$id = $this->input->post("id");
		$this->ExcursoesModel->registrarAutorizacao($id);
	}

	public function alterar_excursao()
	{
		$id = $this->input->post("excursao")['id_excursao'];
		$excursao = $this->ExcursoesModel->verDetalhesExcursao($id);
		$dados = array('excursao' => $excursao, 'usuario_logado' => $this->session->userdata('usuario_logado')['id_usuario']);
		$this->load->template('excursoes/alterar_excursao', '', $dados);
	}

	public function ver_inscritos()
	{
		$id = $this->input->post("excursao")['id_excursao'];
		$dados = array('inscritos' => $this->InscricoesModel->verInscritosExcursao($id));
		$this->load->template('excursoes/ver_inscritos', '', $dados);
	}

	public function ver_detalhes_excursao($id, $msg)
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

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'msg' => $msg, 'insc_pagseguro' => $status['pagseguro']);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
