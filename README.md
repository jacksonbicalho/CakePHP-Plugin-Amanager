Amanager
==========

Gerenciador de acesso para aplicações desenvolvidas em cakePHP

Desenvolvido e testado no cakePHP 2.+

Principais características
---------------------------

1. Gerenciamento de grupos
2. Gerenciamento de usuários (Podendo os usuários pertencerem a um ou mais grupos)
3. Gerenciamento de regras (Atribuídas a um ou mais grupos)

Instalação
-----------

1. git submodule add https://github.com/jacksonbicalho/Amanager.git app/Plugin/Amanager

2. Referencie o componente do Plugin  em $components em seu AppController

        <?php
          var $components = array(
            'Amanager.Amanager' => array(
              'login_action' => array('controller'=>'users', 'action'=>'login', 'plugin'=>'amanager', 'admin'=>false ),
              'login_redirect' => array('controller'=>'amanager', 'plugin' => 'amanager', 'action'=>'index', 'admin'=>false ),
              'logout_redirect' => array('controller'=>'pages', 'plugin' => false, 'action'=>'display', 'admin'=>false )
            ),
          );
        ?>

3. Em beforeFilter chame o compontente do plugin passando o controlador atual

        <?php
          public function beforeFilter(){
            $this->Amanager->beforeFilter($this);
          }
        ?>

4. Em seu boostrap

        <?php
          $global_urls_livres = array(
            array('controller'=>'pages', 'action'=>'display'),
            array('controller'=>'users', 'action'=>'logout', 'plugin'=>'amanager'),
            array('controller'=>'users', 'action'=>'login', 'plugin'=>'amanager'),
            array('controller'=>'users', 'action'=>'access_denied', 'plugin'=>'amanager'),
            // Para a recuperação de senha de usuários
            array('controller'=>'users', 'action'=>'recover_password', 'plugin'=>'amanager'),
          );
          Configure::write('Global.urls_livres',$global_urls_livres);
        ?>



        <?php
          CakePlugin::loadAll(array(
            'Amanager' => array('bootstrap' => true),
          ));
        ?>



