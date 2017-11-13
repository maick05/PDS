<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AvaliacoesModel extends CI_Model
{
	public function inserirAvaliacao($avaliacao)	// Insere usuario no banco
	{
	 	$this->db->insert("avaliacoes", $avaliacao);
	}

	public function verificarAvaliacao($id_av, $id_c)
	{
		$this->db->select("id_avaliacao");
		$this->db->from("avaliacoes");
		$this->db->where('id_avaliador', $id_av);
		$this->db->where('id_criador', $id_c);
	 	return $this->db->get()->row_array()['id_avaliacao'];
	}

	public function retornarMedia($id_c)
	{
		$this->db->select("CAST(AVG(avaliacao) AS DECIMAL(10,2)) as media, count(avaliacao) as numero");
		$this->db->from("avaliacoes");
		$this->db->where('id_criador', $id_c);
	 	return $this->db->get()->row_array();
	}

	public function retornarMediaNum($id_c)
	{
		$this->db->select("CAST(AVG(avaliacao) AS DECIMAL(10,2)) as media, count(avaliacao) as numero");
		$this->db->from("avaliacoes");
		$this->db->where('id_criador', $id_c);
	 	return $this->db->get()->result();
	}

	public function atualizarAvaliacao($id, $av)
	{
		$this->db->set("avaliacao", $av);
		$this->db->where('id_avaliacao', $id);
		$this->db->update("avaliacoes");
	}

	public function retornarAvaliacao($id_v, $id_c)
	{
		$this->db->select("avaliacao");
		$this->db->from("avaliacoes");
		$this->db->where('id_avaliador', $id_v);
		$this->db->where('id_criador', $id_c);
	 	return $this->db->get()->row_array()['avaliacao'];
	}

}
?>