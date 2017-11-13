<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlterarPontosParadaController extends CI_Controller 
{
	public function adicionar_ponto()	  //Cadastra o usuario
	{
		$id_excursao = $this->input->post("id_excursao");
		$tipo = $this->input->post("tipo");
		$lat = $this->input->post("lat");
		$long = $this->input->post("long");

		$ponto = array('id_excursao' => $id_excursao, 'tipo' => $tipo, 'lat' => $lat, 'long' => $long);
		$id = $this->PontosParadaModel->verificarPonto($id_excursao, $tipo);
		if (($tipo == "Ponto de partida" || $tipo == "Ponto de chegada") && $id) 
		{
			$this->PontosParadaModel->removerPonto($id);
		}
		$this->PontosParadaModel->inserirPonto($ponto);
	}

	public function retornar_pontos()	  //Cadastra o usuario
	{
		$id = $this->input->post("id_excursao");
		$pontos = $this->PontosParadaModel->retornarPontos($id);
		echo json_encode($pontos);
	}

	public function remover_ponto()	  //Cadastra o usuario
	{
		$id = $this->input->post("id_ponto");
		$this->PontosParadaModel->removerPonto($id);
	}
}
