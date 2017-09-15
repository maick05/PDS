<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadosModel extends CI_Model
{
	function listarEstados()
	{
		$this->db->select('id_estado, nome');
		return $this->db->get('estados')->result_array();
	}
}
?>