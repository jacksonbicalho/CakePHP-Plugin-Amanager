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
    array('controller'=>'users', 'action'=>'index', 'plugin'=>'amanager'),
    array('controller'=>'users', 'action'=>'edit', 'plugin'=>'amanager'),
    array('plugin'=>'amanager', 'controller'=>'amanager', 'action'=>'index'),

    array('plugin'=>'amanager', 'controller'=>'rules', 'action'=>'add'),
    array('plugin'=>'amanager', 'controller'=>'rules', 'action'=>'delete'),
    array('plugin'=>'amanager', 'controller'=>'rules', 'action'=>'index'),
    array('plugin'=>'amanager', 'controller'=>'rules', 'action'=>'edit'),
  )
);
