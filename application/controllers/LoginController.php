<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller 
{
    public function index()                     // Manda para a página padrão do sistema caso usuário não esteja logado
    {
        $this->load->view('usuarios/login');        
    }

    public function go_cadastro()               // Vai para a página de cadastro
    {
        $this->load->view('usuarios/cadastro');
    }

    public function verificar_login()   // Método que verifica se o email e senha estão corretos
    {
        $usuario = array('email' => $this->input->post("email"), 'senha' => $this->input->post("senha"));
        $usuario_logado = $this->UsuariosModel->verificaLogin($usuario);
        if($usuario_logado)     // Verifica se a consulta está vazia ou não                 
        {
            echo "sucesso";
        }
        else
        {
            echo "erro";
        }   
    }

    public function logar()     // Método de login
    {
        $usuario = $this->UsuariosModel->retornaUsuario('email', $this->input->post("usuarios")['email']);
        $this->session->set_userdata("usuario_logado" , $usuario);
        $dados = array('cadastro' => false);
        $this->load->template('estrutura/home', '', $dados);    
    }

    public function recuperar_senha()
    {
        $email = $this->input->post("email");
        $usuario = $this->UsuariosModel->retornaDadosChave($email);
        $chave = md5($email.$usuario['senha'].$usuario['id_usuario']);
        $this->enviar_email($email, $chave, $usuario['nome']);
    }

    public function validar_chave()
    {
        $chave_get = $this->input->get("key");
        $email = $this->input->get("email");
        $usuario = $this->UsuariosModel->retornaDadosChave($email);
        $chave = md5($email.$usuario['senha'].$usuario['id_usuario']);
        if ($chave_get == $chave) 
        {
            $dados = array('ref' => true, 'id_u' => $usuario['id_usuario']);
            $this->load->view('usuarios/login', $dados);
        }
        else
        {
            $this->load->view('usuarios/login', $dados);   
        }
    }

    public function redefinir_senha()
    {
        $senha = $this->input->post("senha");
        $id = $this->input->post("id");
        $this->UsuariosModel->redefinirSenha($senha, $id);
    }

    public function enviar_email($email, $chave, $nome)
    {
        $this->load->library('email');
        //Inicia o processo de configuração para o envio do email
        $config['protocol'] = 'mail'; // define o protocolo utilizado
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
         
        /*
         * Se o usuário escolheu o envio com template, define o 'mailtype' para html, 
         * caso contrário usa text
         */
        if(isset($dados['template']))
            $config['mailtype'] = 'html';
        else
            $config['mailtype'] = 'text';
 
        // Inicializa a library Email, passando os parâmetros de configuração
        $this->email->initialize($config);
        
        // Define remetente e destinatário
        $this->email->from("suporte@mytour-pds.com", 'Suporte - MyTour'); // Remetente
        $this->email->to($email,"Pessoa"); // Destinatário
 
        // Define o assunto do email
        $this->email->subject('MyTour - Recuperação de senha');
 
        /*
         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
         * caso contrário passa somente o conteúdo do campo 'mensagem'
         */
        if(isset($dados['template']))
            $this->email->message($this->load->view('email-template',$dados, TRUE));
        else
            $this->email->message("Olá ".$nome.", você solicitou uma redefinição de senha da conta no MyTour. Para redefinir sua senha acesse
                esse link: www.mytour-pds.com/get_key?key=".$chave."&email=".$email);
         
        /*
         * Se foi selecionado o envio de um anexo, insere o arquivo no email 
         * através do método 'attach' da library 'Email'
         */
        if(isset($dados['anexo']))
            $this->email->attach('./assets/images/unici/logo.png');
 
        /*
         * Se o envio foi feito com sucesso, define a mensagem de sucesso
         * caso contrário define a mensagem de erro, e carrega a view home
         */
        if($this->email->send())
        {
            echo "feito";
        }
        else
        {
            echo $this->email->print_debugger();
        }
        
    }
}
