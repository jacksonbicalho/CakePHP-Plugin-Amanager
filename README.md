Amanager
==========

Access Manager for cakePHP

Desenvolvido e testado no cakePHP 2.2.2

Amanager é um plugin gerenciador de acesso

Principais características
---------------------------

1. Gerencianto de grupos
2. Gerenciamento de usuários (Podendo esses pertencerem a um ou mais grupos)
3. Gerenciamento de regras (que são atribuídas a um ou mais grupos)

Instalação
-----------

1. Em seu projeto entre em app/Plugin

2. Usando o git digite git clone git@github.com:jacksonbicalho/Amanager.git ou baixe o Plugin (https://github.com/jacksonbicalho/Amanager/archive/master.zip) e descompacte na mesmo diretório

3. Em seu AppController insira

    <?php
      var $components = array(
        'Amanager.Amanager' => array(
          'login_action' => array('controller'=>'users', 'action'=>'login', 'plugin'=>'amanager', 'admin'=>false ),
          'login_redirect' => array('controller'=>'amanager', 'plugin' => 'amanager', 'action'=>'index', 'admin'=>false ),
          'logout_redirect' => array('controller'=>'pages', 'plugin' => false, 'action'=>'display', 'admin'=>false )
        ),
      );

      public function beforeFilter(){
        $this->Amanager->beforeFilter($this);
      }
    ?>


4. Em seu boostrap

    <?php
      CakePlugin::loadAll(array(
        'Amanager' => array('bootstrap' => true),
      ));
    ?>

5. Ainda em seu boostrap


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