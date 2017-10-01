<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguroController extends CI_Controller 
{
	public function abrir_pagamento()
	{
		$data['token'] ='B85F168A57CA4B92B9923CC6C295F3B5';
		$data['email'] = 'my.tour.pds@gmail.com';
		$data['currency'] = 'BRL';
		$data['itemId1'] = '1';
		$data['itemQuantity1'] = '1';
		$data['itemDescription1'] = $this->input->post("nome");
		$data['itemAmount1'] = $this->input->post("valor");

		$this->insere_pagamento($this->input->post("id_inscricao"));
		$data['reference'] = $this->PagamentosModel->retornarId();

		$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

		$data = http_build_query($data);

		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		$xml= curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);
		echo $xml -> code;
	}

	public function insere_pagamento($id)
	{
		$pagamento = array('id_inscricao' => $id, 'situacao' => "Aguardando pagamento", 'data_abertura' => date("Y/m/d h:i:s"));
		$this->PagamentosModel->inserirPagamento($pagamento);
	}

	public function verificar_pagamento()
	{

		$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

		$data['token'] ='B85F168A57CA4B92B9923CC6C295F3B5';
		$data['email'] = 'my.tour.pds@gmail.com';

		$data = http_build_query($data);

		$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		$xml = curl_exec($curl);
		curl_close($curl);

		$xml = simplexml_load_string($xml);

		$reference = $xml->reference;
		$status = $xml->status;

		echo $status;
	}
}
