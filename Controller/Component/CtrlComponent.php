<?php
App::uses('Folder', 'Utility');
class CtrlComponent extends Component {

    /**
     * Retorna um vetor contendo todos os diretórios existentes
     * nos diretórios definidos para plugins
     * @return array
     */
    public function get_plugins() {
        $pluginPaths = App::path('Plugin');
        $plugins = array();
        foreach ($pluginPaths as $key => $pluginPath) {
            $dir_plugin = new Folder($pluginPath);
            $d = $dir_plugin->read(false);
            $_plugins[] = $d[0];
            $plugins = array();
            foreach ($_plugins as $key => $value) {
                $plugins = array_merge($plugins, $value);
            }
        }
        return $plugins;
    }

  /**
   * Retorna um vetor contendo todos os controllers existentes em um plugin
   * informado
   * lenvando em consideração que o componente esteja rodando em um plugin
   *
   * @params string $plugin
   * @return array
   */
  public function get_controlles_plugins($plugin, $str_controller = false) {

    if(!$plugin) return $this->get_controllers($str_controller);

    $dir_plugin = new Folder("../Plugin/{$plugin}");
    $_controllers = $dir_plugin->cd('Controller');
    $_controllers = $dir_plugin->read('.*\.*');

    $controllers = array();
    foreach($_controllers as $k => $v){
      foreach($v as $_k => $_v){
        if($_v != $plugin.'AppController.php' && $_v != 'Component'){
          $_v = str_replace('.php', '', $_v);
          $controllers["{$plugin}.{$_v}"] = $_v;
        }
      }

    }

    return $str_controller?$this->_str_controller($controllers):$controllers;

  }

  /**
   * Retorna os métodos de um controller informado
   *
   * @params string $controller
   * @return array
   */
  public function get_methods_controlles($controller) {

    $controller = str_replace('Controller', '', $controller);
    $_controller = explode('.', $controller);

    if ( count($_controller)>1 ){
      App::uses("{$_controller[1]}Controller", "{$_controller[0]}.Controller");
      $aMethods = get_class_methods("{$_controller[1]}Controller");
    }else{

      App::import('Controller', str_replace('Controller', '', "{$_controller[0]}Controller"));
      $aMethods = get_class_methods("{$controller}Controller");
    }
    $array_exclude = array(
      'beforeFilter',
      'setRequest',
      'invokeAction',
      'implementedEvents',
      'constructClasses',
      'getEventManager',
      'startupProcess',
      'shutdownProcess',
      'httpCodes',
      'loadModel',
      'redirect',
      'header',
      'set',
      'setAction',
      'validate',
      'validateErrors',
      'render',
      'referer',
      'disableCache',
      'flash',
      'postConditions',
      'paginate',
      'beforeRender',
      'beforeRedirect',
      'afterFilter',
      'beforeScaffold',
      'afterScaffoldSave',
      'afterScaffoldSaveError',
      'scaffoldError',
      'toString',
      'requestAction',
      'dispatchMethod',
      'log',
    );

    if($aMethods){
      foreach ($aMethods as $idx => $method) {
        $methods[$method] = $method;
        if ($method{0} == '_') {
          unset($methods[$method]);
        }
        if ( in_array($method, $array_exclude) ) {
          unset($methods[$method]);
        }

      }
    }

    return $methods;

  }

  /**
   * Retorna um vetor contendo todos os controllers do sistema
   *
   * @return array
   */
  public function get_controllers($str_controller = false) {

    $aCtrlClasses = App::objects('controller');

    foreach ($aCtrlClasses as $controller) {
      if ($controller != 'AppController') {
        // Load the controller
        App::import('Controller', str_replace('Controller', '', $controller));

        $controllers[$controller] = $controller;
      }
    }

    return $str_controller?$this->_str_controller($controllers):$controllers;
  }

  /**
   * Remove o texto Controller
   *
   * @param array $data
   * @return array
   */

  public function _str_controller($data){
    return str_replace('Controller', '', $data);

  }



public function get_teste() {
  $aCtrlClasses = App::objects('controller');
  foreach ($aCtrlClasses as $controller) {
    if ($controller != 'AppController') {
      // Load the controller
      App::import('Controller', str_replace('Controller', '', $controller));

      // Load its methods / actions
      $aMethods = get_class_methods($controller);

      foreach ($aMethods as $idx => $method) {

          if ($method{0} == '_') {
              unset($aMethods[$idx]);
          }
      }

      // Load the ApplicationController (if there is one)
      App::import('Controller', 'AppController');
      $parentActions = get_class_methods('AppController');

      $controllers[$controller] = array_diff($aMethods, $parentActions);
    }
  }
  return $controllers;
}









}
