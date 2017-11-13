<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilController extends CI_Controller 
{
	public function listar_estados()  // Lista os estados do no select dos estados
	{
		echo json_encode($this->EstadosModel->listarEstados());
	}

	public function listar_cidades()	// Lista as cidades no select de acordo com o estado selecionado
	{
		$id = $this->input->post("id");
		echo json_encode($this->CidadesModel->listarCidadesPorEstado($id));
	}

	public function alterar_perfil()
	{
		if (isset($_FILES['url_foto'])) 
		{
			$retorno = $this->salvar_foto();
			if ( $retorno != "erro" && $retorno != "igual") 
			{
				$usuario = $this->input->post("usuarios");
				$usuario['url_foto'] = $retorno;
				$usuario['email'] = $this->session->userdata('usuario_logado')['email'];
				$foto_antiga = $this->session->userdata('usuario_logado')['url_foto'];
				if (isset($foto_antiga) && file_exists($foto_antiga)) 
				{
					unlink($foto_antiga);
				}
				$this->UsuariosModel->atualizarPerfil($usuario);
				$this->session->set_userdata("usuario_logado" , $usuario);
				$this->meu_perfil();
			}
			else if ($retorno == "igual")
			{
				$usuario = $this->input->post("usuarios");
				$usuario['email'] = $this->session->userdata('usuario_logado')['email'];
				$usuario['url_foto'] = $this->session->userdata('usuario_logado')['url_foto'];
				$this->UsuariosModel->atualizarPerfil($usuario);
				$this->session->set_userdata("usuario_logado" , $usuario);
				$this->meu_perfil();
			}
			else
			{
				$dados = array('usuario_logado' => $this->session->userdata('usuario_logado'), 'msg' => "Foto Inválida!", 'tipo' => 'red');
				$this->load->template('usuarios/perfil', '', $dados);	
			}
		}
		else
		{
			$usuario = $this->input->post("usuarios");
			$usuario['email'] = $this->session->userdata('usuario_logado')['email'];
			$this->UsuariosModel->atualizarPerfil($usuario);
			$this->session->set_userdata("usuario_logado" , $usuario);
			$this->meu_perfil();
		}
	}

	public function meu_perfil()						// Manda para a página padrão do sistema caso usuário não esteja logado
	{	
		$dados = array('usuario_logado' => $this->session->userdata('usuario_logado'), 'msg' => "Alterações salvas com sucesso!", 'tipo' => 'green');
		$this->load->template('usuarios/perfil', '', $dados);	
	}

	public function salvar_foto()
	{
		$foto = $_FILES['url_foto'];
		$usuario = $this->session->userdata('usuario_logado');
		$name = md5($usuario['id_usuario'].$usuario['nome'].Date("d/m/Y H:i:s"));

   		$configuracao = array(
   		   'upload_path' => 'assets/img/usuarios/',
   		   'allowed_types' => 'jpg|png',
   		   'file_name' => $name.'.jpg',
   		   'max_size' => '3000000'
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
				echo $valida;
				return "erro";
			}
		}
		else
		{
			if ($this->upload->display_errors() == "<p>You did not select a file to upload.</p>")
			{
				return "igual";  
			}
			else
			{
				echo $this->upload->display_errors();
				return "erro";
			}
		}
	}
}
