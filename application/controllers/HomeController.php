<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller 
{
	public function cadastrar_usuario()
	{
		$usuario = $this->input->post("usuarios");
		$this->UsuariosModel->inserirUsuario($usuario);
	}

	public function verificar_email()
	{
		$email = $this->input->post("email");
		echo $this->UsuariosModel->verificaEmail($email);
	}
}
