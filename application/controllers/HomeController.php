<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller 
{
	public function listar_estados()  // Lista os estados do no select dos estados
	{
		echo json_encode($this->EstadosModel->listarEstados());
	}

	public function home()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{
		$this->load->view('estrutura/index');		
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
			//ERRRRROOOOOOOO
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

	function go_home()
	{
		$this->load->template('estrutura/home', '', '');
	}
}
