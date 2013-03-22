<?php
/*
 * Endereços liberados por padrão
 *
 * var urls_livres
 *
 */
Configure::write('Amanager.urls_livres',
  array(
    array('controller'=>'pages', 'action'=>'display'),
    array('controller'=>'users', 'action'=>'logout', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'login', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'access_denied', 'plugin'=>'amanager'),

    // Para a recuperação de senha de usuários
    array('controller'=>'users', 'action'=>'recover_password', 'plugin'=>'amanager'),

  )
);

/*
 * Define qual o controle e ação da página inicial
 *
 * var urls_livres
 *
 */
Configure::write('Amanager.page_ini', array('plugin'=>false, 'controller' => 'pages', 'action' => 'display') );
