<?php
/*
 * Endereços liberados por padrão
 *
 * var urls_livres
 *
 */
  $amanager_urls_livres = array(
    array('controller'=>'pages', 'action'=>'display'),
    array('controller'=>'users', 'action'=>'logout', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'login', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'access_denied', 'plugin'=>'amanager'),
    // Para a recuperação de senha de usuários
    array('controller'=>'users', 'action'=>'recover_password', 'plugin'=>'amanager'),
  );

/*
 * Lê a variável Global.urls_livres definida na aplicação em que o plugin está instalado para inserir
 * as urls como livre para o plugin
 *
 *
 */
  foreach ( Configure::read('Global.urls_livres' ) as $url_livre){
    $amanager_urls_livres[] = $url_livre;
  }
  Configure::write('Amanager.urls_livres',$amanager_urls_livres);

/*
 * Define qual o controle e ação da página inicial
 *
 * var urls_livres
 *
 */
Configure::write('Amanager.page_ini', array('plugin'=>false, 'controller' => 'pages', 'action' => 'display') );

/*
 * Define qual o o grupo é definido como grupo master (Acesso total)
 *
 * var group_master
 *
 */
Configure::write('Amanager.group_master', 'MASTER' );