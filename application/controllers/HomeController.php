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
		$usuario = array('telefone' => $this->input->post("telefone"), 'celular' => $this->input->post("celular"), 
			'id_estado' => $this->input->post("id_estado"), 'id_cidade' => $this->input->post("id_cidade"),
			'data_nasc' => $this->input->post("data_nasc"));

		if ($this->salvar_foto())
		{
			$this->UsuariosModel->concluirCadastro($usuario, $this->session->userdata('usuario_logado'));
			$usuario = $this->UsuariosModel->retornaUsuario('id_usuario', $this->session->userdata('usuario_logado')['id_usuario']);
			$this->session->set_userdata("usuario_logado" , $usuario);
		}
	}

	public function salvar_foto()
	{
		$foto = $this->input->post("url_foto");
		$usuario = $this->session->userdata('usuario_logado');
		$name = md5($usuario['id_usuario'].$usuario['nome'].$usuario['email'].Date("d/m/Y H:i:s"));

   		$configuracao = array(
   		   'upload_path' => 'assets/img/usuarios/',
   		   'allowed_types' => 'jpg',
   		   'file_name' => $name.'.jpg',
   		   'max_size' => '3000'
   		);

   		$this->upload->initialize($configuracao);

   		if ($this->upload->do_upload('foto'))
		{
			
			return true;
		}
		else
		{
			//echo $this->upload->display_errors();
			return false;
		}
	}
}
