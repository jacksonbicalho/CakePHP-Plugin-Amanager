<?php

/**
 * Usuários
 */
Router::connect(
    '/admin/users',
    array(
        'plugin'=>'amanager',
        'controller'=>'users',
        'action'=>'index'
    )
);
Router::connect(
    '/admin/users/:action/*',
    array(
        'plugin'=>'amanager',
        'controller'=>'users',
    )
);
Router::connect(
    '/admin/logout',
    array('plugin'=>'amanager','controller'=> 'users', 'action'=>'logout')
);

/**
 * Grupos
 */
Router::connect(
    '/admin/groups',
    array(
        'plugin'=>'amanager',
        'controller'=>'groups',
        'action'=>'index'
    )
);
Router::connect(
    '/admin/groups/:action/*',
    array(
        'plugin'=>'amanager',
        'controller'=>'groups',
    )
);

/**
 * Regras
 */
Router::connect(
    '/admin/rules',
    array(
        'plugin'=>'amanager',
        'controller'=>'rules',
        'action'=>'index'
    )
);
Router::connect(
    '/admin/rules/:action/*',
    array(
        'plugin'=>'amanager',
        'controller'=>'rules',
    )
);
