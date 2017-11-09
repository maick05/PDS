<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InscricoesModel extends CI_Model
{
	public function inserirInscricao($inscricao)	// Insere usuario no banco
	{
		$inscricao['status'] = "pendente";
		$this->db->insert("inscricoes", $inscricao);
	}

	public function atualizarStatus($status, $id)
	{
		$this->db->set('status', $status);
		$this->db->where('id_inscricao', $id);
		$this->db->update('inscricoes');
	}

	public function confirmarPagSeguro($id, $ps)
	{
		$this->db->set('pagseguro', $ps);
		$this->db->where('id_inscricao', $id);
		$this->db->update('inscricoes');
	}

	public function deletarInscricao($id)
	{
		$this->db->where('id_inscricao', $id);
		$this->db->delete('inscricoes');
	}

	public function verificarInscricao($id_inscrito, $id_excursao)
	{
		$this->db->select('status, id_inscricao, pagseguro');
		$this->db->where("id_inscrito", $id_inscrito);
		$this->db->where("id_excursao", $id_excursao);
		return $this->db->get('inscricoes')->row_array();
	}

	public function verInscritosExcursao($id)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('usuarios.nome, usuarios.telefone, usuarios.celular, usuarios.email, usuarios.url_foto, id_inscricao, status, excursoes.nome as nome_excursao, inscricoes.pagseguro as insc_pag, excursoes.id_excursao as id_exc');
		$this->db->from('inscricoes');
		$this->db->join('usuarios', 'usuarios.id_usuario = id_inscrito');
		$this->db->join('excursoes', 'excursoes.id_excursao = inscricoes.id_excursao');
		$this->db->where('inscricoes.id_excursao', $id);
		return $this->db->get();
	}

}
?>