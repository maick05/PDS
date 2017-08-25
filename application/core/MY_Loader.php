<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_loader {
//dados usuario = cabeçalho
//dados = conteúdo da view
	public function template($nome, $estrutura = array(), $dados = array())
	{
		if (isset($_SESSION['usuario_logado']))
		{
			$this->view("estrutura/index.php", $estrutura);
			$this->view($nome, $dados);
			$this->view("estrutura/footer.php");
		}
		else
		{
			$this->view('usuarios/login.php');
		}
	}
}