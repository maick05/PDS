<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
	public function inserirUsuario($usuario)	// Insere usuario no banco
	{
		$usuario['senha'] = md5($usuario['senha']);
		$this->db->insert("usuarios", $usuario);
	}

	public function concluirCadastro($usuario)	//Atualiza o cadastro do usuário
	{
		$this->db->set('telefone', $this->isNull($usuario['telefone']));
		$this->db->set('celular', $this->isNull($usuario['celular']));
		$this->db->set('id_cidade', $this->isNull($usuario['id_cidade']));
		$this->db->set('id_estado', $this->isNull($usuario['id_estado']));
		$this->db->set('data_nasc', $this->isNull($usuario['data_nasc']));
		$this->db->set('url_foto', $this->isNull($usuario['url_foto']));
		$this->db->where('id_usuario', $usuario['id_usuario']);
		$this->db->update('usuarios');
	}

	public function atualizarPerfil($usuario)	//Atualiza o cadastro do usuário
	{
		$this->db->set('nome', $this->isNull($usuario['nome']));
		$this->db->set('email', $this->isNull($usuario['email']));
		$this->db->set('telefone', $this->isNull($usuario['telefone']));
		$this->db->set('celular', $this->isNull($usuario['celular']));
		$this->db->set('id_cidade', $this->isNull($usuario['id_cidade']));
		$this->db->set('id_estado', $this->isNull($usuario['id_estado']));
		$this->db->set('data_nasc', $this->isNull($usuario['data_nasc']));
		$this->db->set('url_foto', $usuario['url_foto']);
		$this->db->where('id_usuario', $usuario['id_usuario']);
		$this->db->update('usuarios');
	}

	public function verificaLogin($usuario)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$usuario['senha'] = md5($usuario['senha']);
		$this->db->select('email, senha');
		$this->db->where('email', $usuario['email']);
		$this->db->where('senha', $usuario['senha']);
		return $this->db->get('usuarios')->row_array();
	}

	public function verificaEmail($email)	//Verifica se o email já existe no cadastro
	{
		$this->db->select('email');
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

	public function retornaUsuario($campo, $valor)	// Retorna o usuário de acordo com o campo e valor enviado
	{
		$this->db->select('*');
		$this->db->where($campo, $valor);
		return $this->db->get('usuarios')->row_array();
	}

	private function isNull($campo)	//Verifica se a variável é nula
	{
		if ($campo != '') 
		{
			return $campo;
		}
		else
		{
			return null;
		}
	}
}
?>