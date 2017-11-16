<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguroController extends CI_Controller 
{
	public function abrir_pagamento()
	{
		$data['appKey'] ='04D4BCD00808C6F3343ACFA43A70F2FB';
		$data['appId'] = 'mytour';
		$data['authorizationCode'] = $this->AutorizacoesModel->resgatarCodigo($this->input->post("id_criador"));
		$data['currency'] = 'BRL';
		$data['itemId1'] = '1';
		$data['itemQuantity1'] = '1';
		$data['itemDescription1'] = $this->input->post("nome");
		$data['itemAmount1'] = '1.50';//$this->input->post("valor");
		$data['redirectURL'] = 'http://www.mytour-pds.com/verificar_pagamento';
		$data['notificationUrl'] = 'http://www.mytour-pds.com/verificar_pagamento';

		
		$data['reference'] = $this->insere_pagamento($this->input->post("id_inscricao"));

		$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

		$data = http_build_query($data);

		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		$xml = curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);
		echo $xml->code;
	}

	public function insere_pagamento($id)
	{
		$pagamento = array('id_inscricao' => $id, 'situacao' => "Aguardando pagamento", 'data_abertura' => date("Y/m/d h:i:s"));
		$this->InscricoesModel->confirmarPagSeguro($id, true);
		return $this->PagamentosModel->inserirPagamento($pagamento);
	}

	public function verificar_pagamento()
	{

		$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

		$appKey ='04D4BCD00808C6F3343ACFA43A70F2FB';
		$appId= 'mytour';

		$url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?appId='.$appId.'&appKey='.$appKey;
		$code = array('registro' => $url, 'data' => date("Y/m/d h:i:s"));
		$this->AutorizacoesModel->registrar($code);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		$xml = curl_exec($curl);
		curl_close($curl);

		$xml = simplexml_load_string($xml);
		$this->atualizarSituacao($xml->reference, $xml->status);
	}

	public function atualizarSituacao($reference, $status)
	{
		$id = $this->PagamentosModel->retornarInscricao($reference);
		switch ($status) 
		{
			case 1:
			{
				$status = "Aguardando pagamento";
				break;
			}
			case 2:
			{
				$status = "Em analise";
				break;
			}
			case 3:
			{
				$status = "Pagamento aprovado";
				$this->InscricoesModel->atualizarStatus("Confirmada", $id);
				break;
			}
			case 4:
			{
				$status = "Pagamento aprovado";
				$this->InscricoesModel->atualizarStatus("Confirmada", $id);
				break;
			}
			case 5:
			{
				$status = "Em disputa";
				break;
			}
			case 6:
			{
				$status = "Devolvido";
				break;
			}
			case 7:
			{
				$status = "Cancelado";
				break;
			}
			case 8:
			{	
				$status = "Debitado";
				break;
			}
			case 9:
			{	
				$status = "Retenção Temporária";
				break;
			}
			default:
			{
				$status = "Desconhecido";
			}
		}

		$this->PagamentosModel->atualizarSituacao($reference, $status);
	}

	public function deletar_pagamento()
	{
		$id_usuario = $this->session->userdata('usuario_logado')['id_usuario'];
		$id_inscricao = $this->input->post("id_inscricao");
		$id_excursao = $this->input->post("id_excursao");

		$id_pagamento = $this->PagamentosModel->retornarId($id_usuario, $id_inscricao, $id_excursao);
		$this->PagamentosModel->deletarPagamento($id_pagamento);
		$this->InscricoesModel->confirmarPagSeguro($id_inscricao, false);
	}

	public function solicita_autorizacao()
	{
		$appKey ='04D4BCD00808C6F3343ACFA43A70F2FB';
		$appId = 'mytour';

		$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/authorizations/request?appId=".$appId."&appKey=".$appKey;
                      
	   //Cria o XML que será enviado ao PagSeguro.
	   $dom = new DOMDocument('1.0', 'utf-8');                      	     
	   $dom->preserveWhiteSpace = false;
	   $dom->formatOutput = true;
	   $permissions   = array('SEARCH_TRANSACTIONS', 'RECEIVE_TRANSACTION_NOTIFICATIONS' ,'CREATE_CHECKOUTS');
	   $authorization = $dom->createElement("authorizationRequest");
	   $permission = $dom->createElement("permissions");
	   foreach ($permissions as $key => $typeAuthorization) {
	       $typeAuthorization = $dom->createElement("code", $typeAuthorization);
	       $permission->appendChild($typeAuthorization);
	   }
	   $redirectURL = $dom->createElement("redirectURL", 'http://www.mytour-pds.com/notificar_autorizacao');
	   $reference = $dom->createElement("reference",  $this->session->userdata('usuario_logado')['id_usuario']);
	   $authorization->appendChild($redirectURL);
	   $authorization->appendChild($permission);
	   $dom->appendChild($authorization);
	   $dom->save("teste.xml");
		
		$url = "https://ws.pagseguro.uol.com.br/v2/authorizations/request?appId=".$appId."&appKey=".$appKey;

		// $data = http_build_query($data);

		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	   	curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=ISO-8859-1"));
	   	curl_setopt($curl, CURLOPT_POSTFIELDS, $dom->saveXML());
		
		$xml = curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);
		echo $xml->code;
	}

	public function notificar_autorizacao()
	{
		$data['appKey'] ='04D4BCD00808C6F3343ACFA43A70F2FB';
		$data['appId'] = 'mytour';

		$data = http_build_query($data);

		$url = 'https://ws.pagseguro.uol.com.br/v2/authorizations/notifications/'.$_GET['notificationCode'].'?'.$data;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL, $url);
		$xml = curl_exec($curl);
		curl_close($curl);

		$xml = simplexml_load_string($xml);

		$aut = array('email' => $xml->authorizerEmail, 'code'=>$xml->code, 'data_aut' => $xml->creationDate, 'status' => $xml->permissions->permission->status, 'id_autorizador' => $xml->reference);
		$id = $this->ExcursoesModel->retornarUltimaExcursaoDoCriador($this->session->userdata('usuario_logado')['id_usuario']);
		$this->atualizar_autorizacao($aut, $id);
		// $this->ver_detalhes_excursao($id);
	}

	public function verificar_situacao_pagamento()
	{
		$id = $this->input->post("id_insc");
		echo $this->PagamentosModel->verificar_pagamento($id);
	}

	public function atualizar_autorizacao($aut, $id)
	{
		$this->AutorizacoesModel->inativarAutorizacoes($this->session->userdata('usuario_logado')['id_usuario']);
		$this->AutorizacoesModel->inserirAutorizacao($aut);
		$this->ExcursoesModel->registrarAutorizacao($id);
	}

	public function ver_detalhes_excursao($id)
	{
		$status = $this->InscricoesModel->verificarInscricao($this->session->userdata('usuario_logado')['id_usuario'], $id);
		if (!$status) 
		{
			$status['status'] = "não inscrito";
			$status['id_inscricao'] = null;
		}

		$dados = array('excursao' => $this->ExcursoesModel->verDetalhesExcursao($id), 'id_usuario' => $this->session->userdata('usuario_logado')['id_usuario'], 'status' => $status['status'], 'inscricao' => $status['id_inscricao']);
		$this->load->template('excursoes/detalhes_excursao', '', $dados);
	}
}
?>
