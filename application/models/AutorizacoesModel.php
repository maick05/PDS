<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutorizacoesModel extends CI_Model
{
	public function inserirAutorizacao($autorizacao)	// Insere usuario no banco
	{
	 	$this->db->insert("autorizacoes", $autorizacao);
	 	return $this->db->insert_id();
	}

	public function verificarAutorizacao($id)
	{
		$this->db->select("id_autorizacao, email");
		$this->db->from("autorizacoes");
		$this->db->where('id_autorizador', $id);
		$this->db->where('status', 'APPROVED');
	 	return $this->db->get()->row_array();
	}

	public function inativarAutorizacoes($id_autorizador)
	{
		$this->db->set("status", 'INATIVA');
		$this->db->where('id_autorizador', $id_autorizador);
		$this->db->update("autorizacoes");
	}

	public function resgatarCodigo($id)
	{
		$this->db->select("code");
		$this->db->from("autorizacoes");
		$this->db->where('id_autorizador', $id);
		$this->db->where('status', 'APPROVED');
	 	return $this->db->get()->row_array()['code'];
	}

	public function registrar($code)	// Insere usuario no banco
	{
	 	$this->db->insert("registro", $code);
	}
}
?>