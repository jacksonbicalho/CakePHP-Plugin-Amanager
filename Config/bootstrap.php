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

)
);
