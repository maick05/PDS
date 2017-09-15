<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExcursoesModel extends CI_Model
{
	public function inserirExcursao($excursao)	// Insere usuario no banco
	{
		$this->db->insert("excursoes", $excursao);
		echo "Excursão criada com sucesso!";
	}

	public function concluirCadastro($usuario, $id)	//Atualiza o cadastro do usuário
	{
		$this->db->set('telefone', $this->isNull($usuario['telefone']));-
		$this->db->set('celular', $this->isNull($usuario['celular']));
		$this->db->set('id_cidade', $this->isNull($usuario['id_cidade']));
		$this->db->set('id_estado', $this->isNull($usuario['id_estado']));
		$this->db->set('data_nasc', $this->isNull($usuario['data_nasc']));
		$this->db->where('id_usuario', $id);
		$this->db->update('usuarios');
	}

	public function buscarExcursoes()	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('excursoes.nome, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		return $this->db->get();
	}

	public function pesquisarExcursoes($nome)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('excursoes.nome, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		$this->db->like('excursoes.nome', $nome);
		return $this->db->get();
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