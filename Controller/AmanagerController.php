<?php
App::uses('AmanagerAppController', 'Amanager.Controller');

/**
 * Amanagers Controller
 *
 */
class AmanagerController extends AmanagerAppController {

  /**
   * uses
   *
   * @var array
   */
  public $uses = array();

  public function index() {
    //$path = APP . 'Plugin' . DS . 'Amanager' . DS . 'VERSION.txt';
    $path = dirname (__DIR__) . DS . 'composer.json';;
    $this->set('version', $this->get_version($path));
  }

	public function admin_index() {
    $this->redirect("amanager");
  }


  /**
   * Returns param version of a file, or false if no version detected.
   * @param $path
   *  The path of the file to check.
   * @param $pattern
   *  A string containing a regular expression (PCRE) to match the
   *  file version. For example: '@version\s+([0-9a-zA-Z\.-]+)@'.
   */
  public function get_version($path, $pattern = '@version\s+([0-9a-zA-Z\.-]+)@') {
    $version = false;

    $string = file_get_contents($path);
    $json_a=json_decode($string,true);
    return $json_a['version'];
  }


}
