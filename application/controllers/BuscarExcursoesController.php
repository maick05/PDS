<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BuscarExcursoesController extends CI_Controller 
{
	public function pesquisar_excursoes($nome)	  //Cadastra o usuario
	{
		$this->load->library('pagination');
		$string = 'pesquisar_excursoes/'.$nome;
		$config['base_url'] = base_url($string);
		$config['total_rows'] = $this->ExcursoesModel->pesquisarExcursoes($nome)->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = 8;
		$config['first_link'] = 'Ínicio';
		$config['last_link'] = FALSE;
		$config['full_tag_open'] = '<ul class="ui floated pagination menu">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="item">';
		$config['cur_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="item">';
		$config['prev_tag_open'] = '<li class="item">';
		$config['next_tag_close'] = '&emsp;&emsp;&emsp;
		</li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="item">';
		$config['last_tag_close'] = '</li>';
		$qtd = $config['per_page'];
		($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;
		$this->pagination->initialize($config); 
		$dados = array('excursoes' => $this->ExcursoesModel->pesquisarExcursoes($nome, $qtd, $inicio), 
		'pagination' => $this->pagination->create_links(), 'pesq' => 'tem');
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
		$pag = $this->PagamentosModel->verificar_pagamento($status['id_inscricao']);
		$rota = $this->PontosParadaModel->retornarPontos($id);
		$media = $this->AvaliacoesModel->retornarMedia($excursao['id_criador']);
		$minha_av = $this->AvaliacoesModel->retornarAvaliacao($this->session->userdata('usuario_logado')['id_usuario'], $excursao['id_criador']);

		$dados = array('excursao' => $excursao, 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao'], 'insc_pagseguro' => $status['pagseguro'], 'rota' => $rota, 'media' => $media, 'minha_av' => $minha_av, 'pag' => $pag);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}

	public function retrieve()
	{
		$nome = $this->input->post("nome");
		$excursoes = $this->ExcursoesModel->pesquisarExcursoes($nome);
		$this->load->template('excursoes/buscar_excursoes', '', $dados);

		$this->load->library('pagination');
		$config['base_url'] = base_url('retrieve');
		$config['total_rows'] = $this->ExcursoesModel->get_all()->num_rows();
		$config['per_page'] = 8;
		$qtd = $config['per_page'];
		($this->uri->segment(2) != '') ? $inicio = $this->uri->segment(2) : $inicio = 0;
		
		$this->pagination->initialize($config);

	}
}
