<?php
App::uses('AppController', 'Controller');
class AmanagerAppController extends AppController {
  var $components = array(
   'Session',
   'RequestHandler',
   'Ctrl'
   );
   public $theme = 'Amanager';
   public $helpers = array(
    'Form',
    'Time',
    'Html',
    'Session',
    'Js',
   );

}

