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

	public function deletarInscricao($id)
	{
		$this->db->where('id_inscricao', $id);
		$this->db->delete('inscricoes');
	}

	public function verificarInscricao($id_inscrito, $id_excursao)
	{
		$this->db->select('status, id_inscricao');
		$this->db->where("id_inscrito", $id_inscrito);
		$this->db->where("id_excursao", $id_excursao);
		return $this->db->get('inscricoes')->row_array();
	}
}
?>