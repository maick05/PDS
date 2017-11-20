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
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('usuarios/login');
	}

	public function go_buscar_excursoes()
	{
		$this->session->unset_userdata('filtros');
		$this->load->library('pagination');
		$config['base_url'] = base_url('buscar_excursoes');
		$config['total_rows'] = $this->ExcursoesModel->buscarExcursoes()->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = 9;
		$config['use_page_numbers'] = TRUE;
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
		if ($this->uri->segment(2) != '') {
			$inicio = $qtd * ($inicio- 1);
		}
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

		if ($config['total_rows'] == 0) 
		{
			$msg = true;
		}
		else
		{
			$msg = null;
		}

		$dados = array('excursoes' => $this->ExcursoesModel->buscarExcursoes($qtd, $inicio), 
			'pagination' => $pagination, 'pesq' => null, 'msg' => $msg);
		$this->load->template('excursoes/buscar_excursoes', '', $dados);	
	}

	public function minhas_excursoes_p()
	{
		$qtd = 1;
		$this->load->library('pagination');

		($this->uri->segment(2) != '') ? $inicio = $this->uri->segment(2) : $inicio = 0;

		$pagC = null;
		$pagP = null;
		$excursoes_participo = $this->ExcursoesModel->verExcursoesParticipo($qtd, $inicio, $this->session->userdata('usuario_logado')['id_usuario']);
		$config['base_url'] = base_url('minhas_excursoes_p');
		$config['total_rows'] = $this->ExcursoesModel->verExcursoesParticipo(0, 0, $this->session->userdata('usuario_logado')['id_usuario'])->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = $qtd;
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
		$this->pagination->initialize($config); 

		if ($config['total_rows'] > $config['per_page']) 
		{
			$pagP = $this->pagination->create_links();
		}
		else
		{
			$pagP = null;
		}

		$excursoes_criei = $this->ExcursoesModel->verExcursoesCriei($qtd, 0, $this->session->userdata('usuario_logado')['id_usuario']);
		$pagC = $this->retorna_me_c($qtd);

		foreach ($excursoes_participo ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}

		
		foreach ($excursoes_criei ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}

		$dados = array('excursoes_participo' => $excursoes_participo, 'excursoes_criei' => $excursoes_criei, 'pagC' => $pagC, 'pagP' => $pagP);
		$this->load->template('excursoes/minhas_excursoes', '', $dados);	
	}

	public function minhas_excursoes_c()
	{
		$qtd = 10;
		$this->load->library('pagination');

		($this->uri->segment(2) != '') ? $inicio = $this->uri->segment(2) : $inicio = 0;

		$pagC = null;
		$pagP = null;
		$excursoes_criei = $this->ExcursoesModel->verExcursoesCriei($qtd, $inicio, $this->session->userdata('usuario_logado')['id_usuario']);
		$config['base_url'] = base_url('minhas_excursoes_c');
		$config['total_rows'] = $this->ExcursoesModel->verExcursoesCriei(0, 0, $this->session->userdata('usuario_logado')['id_usuario'])->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = $qtd;
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
		$this->pagination->initialize($config); 

		if ($config['total_rows'] > $config['per_page']) 
		{
			$pagC = $this->pagination->create_links();
		}
		else
		{
			$pagC = null;
		}

		$excursoes_participo = $this->ExcursoesModel->verExcursoesParticipo($qtd, 0, $this->session->userdata('usuario_logado')['id_usuario']);
		$pagP = $this->retorna_me_p($qtd);

		foreach ($excursoes_participo ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}

		
		foreach ($excursoes_criei ->result() as $linha) 
		{
			$linha->vagas =  $this->ExcursoesModel->retornarVagas($linha->id_exc);
		}

		$dados = array('excursoes_participo' => $excursoes_participo, 'excursoes_criei' => $excursoes_criei, 'pagC' => $pagC, 'pagP' => $pagP);
		$this->load->template('excursoes/minhas_excursoes', '', $dados);	
	}

	public function retorna_me_p($qtd)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url('minhas_excursoes_p');
		$config['total_rows'] = $this->ExcursoesModel->verExcursoesParticipo(0, 0, $this->session->userdata('usuario_logado')['id_usuario'])->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = $qtd;
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
		$this->pagination->initialize($config); 

		if ($config['total_rows'] > $config['per_page']) 
		{
			return $this->pagination->create_links();
		}
		else
		{
			return null;
		}
	}

	public function retorna_me_c($qtd)
	{
		$this->load->library('pagination');	
		$config['base_url'] = base_url('minhas_excursoes_c');
		$config['total_rows'] = $this->ExcursoesModel->verExcursoesCriei(0, 0, $this->session->userdata('usuario_logado')['id_usuario'])->num_rows();
		$config['num_links'] = 10;
		$config['per_page'] = $qtd;
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
		
		$this->pagination->initialize($config); 

		if ($config['total_rows'] > $config['per_page']) 
		{
			return $this->pagination->create_links();
		}
		else
		{
			return null;
		}
	}

}