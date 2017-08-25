<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'loginController';

$route['cadastro'] = 'LoginController/go_cadastro';
$route['login'] = 'LoginController/index';
$route['cadastrar'] = 'CadastroController/cadastrar_usuario';
$route['logar'] = 'LoginController/logar';
$route['verificar_login'] = 'LoginController/verificar_login';
$route['verificar_email'] = 'CadastroController/verificar_email';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
