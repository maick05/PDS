<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'loginController';

$route['cadastro'] = 'LoginController/go_cadastro';
$route['login'] = 'LoginController/index';
$route['cadastrar'] = 'CadastroController/cadastrar_usuario';
$route['logar'] = 'LoginController/logar';
$route['verificar_login'] = 'LoginController/verificar_login';
$route['verificar_email'] = 'CadastroController/verificar_email';
$route['listar_estados'] = 'HomeController/listar_estados';
$route['cidades_por_estado'] = 'HomeController/listar_cidades';
$route['concluir_cadastro'] = 'HomeController/concluir_cadastro';
$route['enviar_email'] = 'LoginController/enviar_email';
$route['home'] = 'HomeController/home';
$route['meu_perfil'] = 'IndexController/go_meu_perfil';
$route['alterar_perfil'] = 'PerfilController/alterar_perfil';
$route['add_excursao'] = 'IndexController/go_add_excursao';
$route['buscar_excursoes'] = 'IndexController/go_buscar_excursoes';
$route['pesquisar_excursoes'] = 'BuscarExcursoesController/pesquisar_excursoes';
$route['criar_excursao'] = 'AddExcursaoController/criar_excursao';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
