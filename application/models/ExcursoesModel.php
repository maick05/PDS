<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExcursoesModel extends CI_Model
{
	public function inserirExcursao($excursao)	// Insere usuario no banco
	{
		$this->db->insert("excursoes", $excursao);
	}

	public function buscarExcursoes($qtd=0,$inicio=0)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('excursoes.nome, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor, excursoes.id_excursao, url_foto');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		$this->db->order_by("data_part");
		if ($qtd > 0) 
		{
			$this->db->limit($qtd, $inicio);
		}
		return $this->db->get();
	}

	public function pesquisarExcursoes($nome, $qtd=0, $inicio=0)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('excursoes.nome, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor, excursoes.id_excursao, url_foto');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		$this->db->like('excursoes.nome', $nome);
		$this->db->order_by("data_part");
		if ($qtd > 0) 
		{
			$this->db->limit($qtd, $inicio);
		}
		return $this->db->get();
	}

	public function verDetalhesExcursao($id)	// Retorna a consulta de um usuário com o email e senha enviados
	{
		$this->db->select('excursoes.*, cidades.nome as cidade_nome, sigla, usuarios.nome as criador');
		$this->db->from('excursoes');
		$this->db->join('usuarios', 'usuarios.id_usuario = excursoes.id_criador');
		$this->db->join('cidades', 'cidades.id_cidade = excursoes.id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = excursoes.id_estado_part');
		$this->db->where('excursoes.id_excursao', $id);
		return $this->db->get()->row_array();
	}

	public function retornarUltimaExcursao()
	{
		$this->db->select('*');
		$this->db->order_by('id_excursao', 'DESC');
		$this->db->limit(1);
		return $this->db->get('excursoes')->row_array();
	}

	public function retornarUltimaExcursaoDoCriador($id)
	{
		$this->db->select('id_excursao');
		$this->db->where('id_criador', $id);
		$this->db->order_by('id_excursao', 'DESC');
		$this->db->limit(1);
		return $this->db->get('excursoes')->row_array()['id_excursao'];
	}

	public function registrarAutorizacao($id)
	{
		$this->db->set('pagseguro', true);
		$this->db->where('id_excursao', $id);
		$this->db->update('excursoes');
	}

	public function alterarFoto($url_foto, $id)
	{
		$this->db->set('url_foto', $url_foto);
		$this->db->where('id_excursao', $id);
		$this->db->update('excursoes');
	}

	public function editarExcursao($excursao)
	{
		$this->db->set('nome', $excursao['nome']);
		$this->db->set('tipo_transporte', $excursao['tipo_transporte']);
		$this->db->set('categoria', $excursao['categoria']);
		$this->db->set('endereco_part', $excursao['endereco_part']);
		$this->db->set('id_estado_part', $excursao['id_estado_part']);
		$this->db->set('id_cidade_part', $excursao['id_cidade_part']);
		$this->db->set('data_part', $excursao['data_part']);
		$this->db->set('horario_part', $excursao['horario_part']);
		$this->db->set('vagas_disp', $excursao['vagas_disp']);
		$this->db->set('valor', $excursao['valor']);
		$this->db->set('contato', $excursao['contato']);
		$this->db->set('contato_email', $excursao['contato_email']);
		$this->db->set('observacoes', $excursao['observacoes']);
		$this->db->where('id_excursao', $excursao['id_excursao']);
		$this->db->update('excursoes');
	}

	public function VerExcursoesParticipo($limit, $id)
	{
		$this->db->select('excursoes.nome, excursoes.id_excursao as id_exc, tipo_transporte, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor, usuarios.nome as nome_criador');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		$this->db->join('usuarios', 'usuarios.id_usuario = excursoes.id_criador');
		$this->db->join('inscricoes', 'excursoes.id_excursao = inscricoes.id_excursao');
		$this->db->where('inscricoes.id_inscrito', $id);
		return $this->db->get();
	}

	public function VerExcursoesCriei($limit, $id)
	{ 
		$this->db->select('excursoes.nome, excursoes.id_excursao as id_exc, tipo_transporte, endereco_part, cidades.nome as cidade_nome, estados.sigla, data_part, horario_part, vagas_disp, valor');
		$this->db->from('excursoes');
		$this->db->join('cidades', 'cidades.id_cidade = id_cidade_part');
		$this->db->join('estados', 'estados.id_estado = id_estado_part');
		$this->db->where('excursoes.id_criador', $id);
		return $this->db->get();
	}

	public function retornarVagas($id)
	{
		$this->db->select('id_inscricao');
		$this->db->from('inscricoes');
		$this->db->where('id_excursao', $id);
		return $this->db->count_all_results();
	}

	public function retornarFoto($id)
	{
		$this->db->select('url_foto');
		$this->db->from('excursoes');
		$this->db->where('id_excursao', $id);
		return $this->db->get()->row_array()['url_foto'];
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