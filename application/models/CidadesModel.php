<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CidadesModel extends CI_Model
{
	function listarCidadesPorEstado($id)	//Lista as cidades de acordo com o estado
	{
		$this->db->select('id_cidade, nome');
		$this->db->where('estados_id_estado', $id);
		return $this->db->get('cidades')->result_array();
	}
}
?>