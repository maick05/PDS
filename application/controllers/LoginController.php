<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller 
{
	public function index()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{
		$this->load->view('usuarios/login');		
	}

	public function go_cadastro()				// Vai para a página de cadastro
	{
		$this->load->view('usuarios/cadastro');
	}

	public function verificar_login()		// Método que verifica se o email e sneha estão corretos
	{
		$usuario = array('email' => $this->input->post("email"), 'senha' => $this->input->post("senha"));
		$usuario_logado = $this->UsuariosModel->verificarLogin($usuario);
		if($usuario_logado)		// Verifica se a consulta está vazia ou não					
		{
			echo "sucesso";
		}
		else
		{
			echo "erro";
		}	
	}

	public function logar()		// Método de login
	{
		$usuario = $this->input->post("usuarios");
		$this->session->set_userdata("usuario_logado" , $usuario);
		$this->load->view('estrutura/home');
		//$this->load->template('estrutura/index', '', '');
	}
}
