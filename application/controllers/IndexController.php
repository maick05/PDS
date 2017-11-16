<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller 
{
	public function go_meu_perfil()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{	
		$dados = array('usuario_logado' => $this->session->userdata('usuario_logado'));
		$this->load->template('usuarios/perfil', '', $dados);	
	}

	public function go_add_excursao()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{	
		$dados = array('usuario_logado' => $this->session->userdata('usuario_logado'));
		$this->load->template('excursoes/add_excursao', '', $dados);	
	}

	public function go_minhas_excursoes()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{	
		$excursoes_participo = $this->ExcursoesModel->verExcursoesParticipo(false, $this->session->userdata('usuario_logado')['id_usuario']);
		foreach ($excursoes_participo ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}
		$excursoes_criei = $this->ExcursoesModel->verExcursoesCriei(false, $this->session->userdata('usuario_logado')['id_usuario']);
		foreach ($excursoes_criei ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}
		$dados = array('excursoes_participo' => $excursoes_participo, 'excursoes_criei' => $excursoes_criei);
		$this->load->template('excursoes/minhas_excursoes', '', $dados);	
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('usuarios/login');
	}

	public function go_buscar_excursoes()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url('buscar_excursoes');
		$config['total_rows'] = $this->ExcursoesModel->buscarExcursoes()->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = 8	;
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
		$config['next_tag_close'] = '&emsp;&emsp;&emsp;</li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="item">';
		$config['last_tag_close'] = '</li>';
		$qtd = $config['per_page'];
		($this->uri->segment(2) != '') ? $inicio = $this->uri->segment(2) : $inicio = 0;
		
		$this->pagination->initialize($config); 

		$pagination;

		if ($config['total_rows'] > $config['per_page']) 
		{
			$pagination = $this->pagination->create_links();
		}
		else
		{
			$pagination = null;
		}

		$dados = array('excursoes' => $this->ExcursoesModel->buscarExcursoes($qtd, $inicio), 
			'pagination' => $pagination, 'pesq' => "nao");
		$this->load->template('excursoes/buscar_excursoes', '', $dados);	
	}
}
