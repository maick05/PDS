<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller 
{
	public function listar_estados()  // Lista os estados do no select dos estados
	{
		echo json_encode($this->EstadosModel->listarEstados());
	}

	public function go_home()					
	{
		$excursoesProx = $this->ExcursoesModel->proximasExcursoes();
		$minhasExcursoes = $this->ExcursoesModel->VerExcursoesCriei(4, 0, $this->session->userdata('usuario_logado')['id_usuario']);
		$sem_ep = null;
		$sem_me = null;
		if ($excursoesProx->num_rows() == 0) 
		{
			$sem_ep = true;
		}
		else
		{
			$sem_ep == null;
		}

		if ($minhasExcursoes->num_rows() == 0) 
		{
			$sem_me = true;
		}
		else
		{
			$sem_me == null;
		}

		$dados = array('excursoesProx' => $excursoesProx, 'sem_ep' => $sem_ep, 'sem_me' => $sem_me, 'minhasExcursoes' => $minhasExcursoes);
		$this->load->template('estrutura/home', '', $dados);		
	}

	public function listar_cidades()	// Lista as cidades no select de acordo com o estado selecionado
	{
		$id = $this->input->post("id");
		echo json_encode($this->CidadesModel->listarCidadesPorEstado($id));
	}

	public function concluir_cadastro()	// Completa o cadastro do usuário
	{
		$usuario = $this->input->post("usuarios");
		$usuario['id_usuario'] = $this->session->userdata('usuario_logado')['id_usuario'];
		$retorno = $this->salvar_foto();
		if ( $retorno != "erro" && $retorno != "vazio") 
		{
			$usuario['url_foto'] = $retorno;
			$this->UsuariosModel->concluirCadastro($usuario);
			$usuario = $this->UsuariosModel->retornaUsuario('id_usuario', $this->session->userdata('usuario_logado')['id_usuario']);
			$this->session->set_userdata("usuario_logado" , $usuario);
			$this->go_home();
		}
		else if($retorno == "vazio")
		{
			$usuario['url_foto'] = "";
			$this->UsuariosModel->concluirCadastro($usuario);
			$usuario = $this->UsuariosModel->retornaUsuario('id_usuario', $this->session->userdata('usuario_logado')['id_usuario']);
			$this->session->set_userdata("usuario_logado" , $usuario);
			$this->go_home();	
		}
		else
		{
			echo "Foto inválida";
		}
	}

	public function salvar_foto()
	{
		$foto = $this->input->post('foto');
		$usuario = $this->session->userdata('usuario_logado');
		$name = md5($usuario['id_usuario'].$usuario['nome'].Date("d/m/Y H:i:s"));

   		$configuracao = array(
   		   'upload_path' => 'assets/img/usuarios/',
   		   'allowed_types' => 'jpg|png',
   		   'file_name' => $name.'.jpg',
   		   'max_size' => '30000'
   		);

   		$this->upload->initialize($configuracao);

   		if ($this->upload->do_upload('url_foto'))
		{
			$caminho = "assets/img/usuarios/".$name.'.jpg';
			include('application/helpers/m2brimagem.class.php');
			$oImg = new m2brimagem($caminho);
			$valida = $oImg->valida();
			if ($valida == 'OK')
			{
				$oImg->redimensiona(245,263,'fill');
			    $oImg->grava($caminho);
			    return $caminho;
			}
			else
			{
				return "erro";
			}
		}
		else
		{
			if ($this->upload->display_errors() == "<p>You did not select a file to upload.</p>")
			{
				return "vazio";
			}
			else
			{
				return "erro";
			}
		}
	}
}
