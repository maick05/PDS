<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalhesExcursaoController extends CI_Controller 
{
	public function inscrever_se()	  //Cadastra o usuario
	{
		$inscricao = $this->input->post("inscricoes");
		$this->InscricoesModel->inserirInscricao($inscricao);
		$this->ver_detalhes_excursao($inscricao['id_excursao'], "Inscrição realizada com sucesso!", null);
	}

	public function cancelar_inscricao()
	{
		$inscricao = $this->input->post("inscricoes");
		$this->InscricoesModel->deletarInscricao($inscricao['id_inscricao']);
		$this->ver_detalhes_excursao($inscricao['id_excursao'], "Sua inscrição foi cancelada com sucesso!", null);
	}

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

	public function alterar_pontos_parada()
	{
		$id = $this->input->post("id_excursao");
		$dados = array('id_excursao' => $id);
		$this->load->template('pontos_parada/alterar_pontos_parada', '', $dados);
	}

	public function ver_inscritos()
	{
		$id = $this->input->post("excursao")['id_excursao'];
		$dados = array('inscritos' => $this->InscricoesModel->verInscritosExcursao($id));
		$this->load->template('excursoes/ver_inscritos', '', $dados);
	}

	public function ver_detalhes_excursao($id, $msg, $msg_exc)
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
		$pag = $this->PagamentosModel->verificar_pagamento($status['id_inscricao']);
		$rota = $this->PontosParadaModel->retornarPontos($id);
		$media = $this->AvaliacoesModel->retornarMedia($excursao['id_criador']);
		$minha_av = $this->AvaliacoesModel->retornarAvaliacao($this->session->userdata('usuario_logado')['id_usuario'], $excursao['id_criador']);

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'msg' => $msg, 'insc_pagseguro' => $status['pagseguro'], 'msg_exc' => $msg_exc, 'rota' => $rota, 'media' => $media, 'minha_av' => $minha_av, 'pag' => $pag);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}

	public function avaliar()
	{
		$avaliacao = array('avaliacao' => $this->input->post("avaliacao"), 'id_criador' => $this->input->post("id_criador"), 'id_avaliador' => $this->session->userdata('usuario_logado')['id_usuario']);
		$id = $this->AvaliacoesModel->verificarAvaliacao($avaliacao['id_avaliador'], $avaliacao['id_criador']);
		if ($id) 
		{
			$this->AvaliacoesModel->atualizarAvaliacao($id, $avaliacao['avaliacao']);
		}
		else
		{
			$this->AvaliacoesModel->inserirAvaliacao($avaliacao);
		}
	}

	public function retornar_media()
	{
		$id = $this->input->post("id_criador");
		$media = $this->AvaliacoesModel->retornarMediaNum($id);
		echo json_encode($media);
	}

	public function alterar_foto()
	{
		$id = $this->input->post("id_excursao");
		if (isset($_FILES['url_foto'])) 
		{
			$retorno = $this->salvar_foto();
			if ( $retorno != "erro" && $retorno != "igual") 
			{
				$url_foto = $retorno;
				$foto_antiga = $this->ExcursoesModel->retornarFoto($id);
				if (isset($foto_antiga) && file_exists($foto_antiga)) 
				{
					unlink($foto_antiga);
				}
				$this->ExcursoesModel->alterarFoto($url_foto, $id);
				$this->ver_detalhes_excursao($id, null, "Foto alterada com sucesso!");
			}
			else if ($retorno == "igual")
			{	
				$this->ver_detalhes_excursao($id,null, "Foto alterada com sucesso!");
			}
			else
			{
				$this->ver_detalhes_excursao($id,null, "Foto inválida");
			}
		}
		else
		{
			$this->ver_detalhes_excursao($id, "Foto alterada com sucesso!");
		}
	}

	public function salvar_foto()
	{
		$foto = $_FILES['url_foto'];
		$criador = $this->session->userdata('usuario_logado')['id_usuario'];
		$id = $this->input->post("id_excursao");
		$name = md5($id.Date("d/m/Y H:i:s").$criador);

   		$configuracao = array(
   		   'upload_path' => 'assets/img/excursoes/',
   		   'allowed_types' => 'jpg|png|jpeg',
   		   'file_name' => $name.'.jpg',
   		   'max_size' => '30000',
   		);

   		$this->upload->initialize($configuracao);

   		if ($this->upload->do_upload('url_foto'))
		{
			$caminho = "assets/img/excursoes/".$name.'.jpg';
			include('application/helpers/m2brimagem.class.php');
			$oImg = new m2brimagem($caminho);
			$valida = $oImg->valida();
			if ($valida == 'OK')
			{
				$oImg->redimensiona(425,283,'fill');
			    $oImg->grava($caminho);
			    return $caminho;
			}
			else
			{
				return "erro";
			}
			
		}
		else
		{
			if ($this->upload->display_errors() == "<p>You did not select a file to upload.</p>")
			{
				return "igual";  
			}
			else
			{
				echo $this->upload->display_errors();
				return "erro";
			}
		}
	}
}
