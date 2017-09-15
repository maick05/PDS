<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadastroController extends CI_Controller 
{
	public function cadastrar_usuario()	  //Cadastra o usuario
	{
		$usuario = $this->input->post("usuarios");
		$this->UsuariosModel->inserirUsuario($usuario);
		$usuario_logado = $this->UsuariosModel->retornaUsuario('email', $usuario['email']);
		$this->logar($usuario_logado);
	}

	public function verificar_email()	//Verifica se o email já está cadastrado
	{
		$email = $this->input->post("email");
		echo $this->UsuariosModel->verificaEmail($email);
	}

	public function logar($usuario)		// Método de login
	{
		$this->session->set_userdata("usuario_logado" , $usuario);
		$dados = array('cadastro' => true);
		$this->load->template('estrutura/home', '', $dados);
	}
}
