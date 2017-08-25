<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
	public function inserirUsuario($usuario)
	{
		$usuario['senha'] = md5($usuario['senha']);
		$this->db->insert("usuarios", $usuario);
	}

	public function verificarLogin($usuario)
	{
		$usuario['senha'] = md5($usuario['senha']);
		$this->db->select('*');
		$this->db->where('email', $usuario['email']);
		$this->db->where('senha', $usuario['senha']);
		return $this->db->get('usuarios')->row_array();
	}

	public function verificaEmail($email)
	{
		$this->db->select('*');
		$this->db->where('email', $email);
		$usuario = $this->db->get('usuarios')->row_array();
		if ($usuario) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function retornaUsuario($campo, $valor)
	{
		$this->db->select('*');
		$this->db->where($campo, $valor);
		return $this->db->get('usuarios')->row_array();
	}
}
?>