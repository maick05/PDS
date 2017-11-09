<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagamentosModel extends CI_Model
{
	public function inserirPagamento($pag)	// Insere usuario no banco
	{
		$this->db->insert("pagamentos_pagseguro", $pag);
		return $this->db->insert_id();
	}

	public function atualizarSituacao($id, $status)
	{
	 	$this->db->set('situacao', $status);
	 	$this->db->set('data_hora_modif', date("Y/m/d h:i:s"));
	 	$this->db->where('id_pagamento', $id);
		$this->db->update('pagamentos_pagseguro');
	}

	public function deletarPagamento($id)
	{
	 	$this->db->where('id_pagamento', $id);
	 	$this->db->delete('pagamentos_pagseguro');
	}

	public function retornarId($id_usuario, $id_inscricao, $id_excursao)
	{
		$this->db->select("pag.id_pagamento as id_pag");
		$this->db->from("pagamentos_pagseguro as pag");
		$this->db->join("inscricoes", "pag.id_inscricao = inscricoes.id_inscricao");
		$this->db->where('inscricoes.id_excursao', $id_excursao);
		$this->db->where('inscricoes.id_inscrito', $id_usuario);
		$this->db->where('pag.id_inscricao', $id_inscricao);
		$this->db->where('pag.situacao', "Aguardando pagamento");
		$this->db->order_by('id_pag', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array()['id_pag'];
	}

	public function retornarInscricao($id)
	{
		$this->db->select("id_inscricao");
		$this->db->from("pagamentos_pagseguro");
		$this->db->where('id_pagamento', $id);
		return $this->db->get()->row_array()['id_inscricao'];
	}
}
?>