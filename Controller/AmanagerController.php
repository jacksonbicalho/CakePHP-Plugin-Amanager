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
    $path = APP . 'Plugin' . DS . 'Amanager' . DS . 'VERSION.txt';
    $this->set('version', $this->get_version($path));
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
    $file = fopen($path, 'r');
    if ($file) {
        while ($line = fgets($file)) {
          if (preg_match($pattern, $line, $matches)) {
            $version = $matches[1];
            break;
          }
        }
        fclose($file);
    }
    return $version;
  }


}
