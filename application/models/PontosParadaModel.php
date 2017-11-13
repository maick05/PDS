<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PontosParadaModel extends CI_Model
{
	public function inserirPonto($ponto)	// Insere usuario no banco
	{
	 	$this->db->insert("pontos_parada", $ponto);
	}

	public function retornarPontos($id)	// Insere usuario no banco
	{
	 	$this->db->select("*");
	 	$this->db->from('pontos_parada');
	 	$this->db->where('id_excursao', $id);
	 	return $this->db->get()->result();
	}

	public function verificarPonto($id, $tipo)	// Insere usuario no banco
	{
	 	$this->db->select("id_ponto");
	 	$this->db->from('pontos_parada');
	 	$this->db->where('id_excursao', $id);
	 	$this->db->where('tipo', $tipo);
	 	return $this->db->get()->row_array()['id_ponto'];
	}

	public function removerPonto($id)	// Insere usuario no banco
	{
	 	$this->db->where('id_ponto', $id);
	 	$this->db->delete('pontos_parada');
	}
}
?>