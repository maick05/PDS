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

	public function go_buscar_excursoes()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{	
		$dados = array('excursoes' => $this->ExcursoesModel->buscarExcursoes());
		$this->load->template('excursoes/buscar_excursoes', '', $dados);	
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
}
