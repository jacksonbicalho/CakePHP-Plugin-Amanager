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
    array('controller'=>'users', 'action'=>'forgot_password', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'recover_password', 'plugin'=>'amanager'),
  );

/*
 * Lê a variável Global.urls_livres definida na aplicação em que o plugin está instalado para inserir
 * as urls como livre para o plugin
 *
 */
  $amanager_urls_livres = array_merge(Configure::read('Global.urls_livres' ), $amanager_urls_livres);
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

/*
 * Define qual o tempo limite para recuperação de senha
 * Definir em segundos
 * Valor padrão 86400 (24 horas)
 *
 * var password_change_code.limit
 *
 */
Configure::write('Amanager.password_change_code.limit', '86400' );

/**
 * Usa os dados da conexão default para criar em tempo de execução
 * a conexação accessmanager, necessário para o funcionamento do plugin
 *
 */
$accessmanager = array('prefix' => 'am_');
App::uses('ConnectionManager', 'Model');
$connection_default =  ConnectionManager::enumConnectionObjects();
$accessmanager = array_merge($connection_default['default'], $accessmanager);
ConnectionManager::create( 'accessmanager', $accessmanager );
