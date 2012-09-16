<?php

class AmanagerComponent extends Component {

  var $components = array('Session');

  function __construct(ComponentCollection $collection, $settings = array()) {
    parent::__construct($collection, $settings);
  }

    function initialize(&$controller) {

      $options = array(
        'loginAction' => Array(
                    'controller' => 'users',
                    'action' => 'login',
                    'plugin' => 'amanager',
                  ),
         'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
         'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
      );
      //$controller->Auth = $controller->Components->load('Auth', $options);

    }

     function startup(&$controller = null) {

      $this->auth($controller);

      /**
       * Use only email instead of user/email (a lot of sites are using this behavior, i.e.: Google,
       * so people is already used to it)
       * Defaults to false so it keeps on the old behavior
       */

      if (Configure::read('Authake.useEmailAsUsername') == null) {
          Configure::write('Authake.useEmailAsUsername', false); //could be true or false
      }

    }

  public function auth(&$controller) {

//pr($controller->request->params);

  }


}

?>
