<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagamentosModel extends CI_Model
{
	public function inserirPagamento($pag)	// Insere usuario no banco
	{
		$this->db->insert("pagamentos_pagseguro", $pag);
	}

	// public function atualizarStatus($status, $id)
	// {
	// 	$this->db->set('status', $status);
	// 	$this->db->where('id_inscricao', $id);
	// 	$this->db->update('inscricoes');
	// }

	// public function deletarInscricao($id)
	// {
	// 	$this->db->where('id_inscricao', $id);
	// 	$this->db->delete('inscricoes');
	// }

	public function retornarId()
	{
		$this->db->select('id_pagamento');
		$this->db->order_by('id_pagamento', 'DESC');
		$this->db->limit(1);
		return $this->db->get('pagamentos_pagseguro')->row_array()['id_pagamento'];
	}
}
?>