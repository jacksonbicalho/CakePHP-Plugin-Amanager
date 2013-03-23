<?php

class AmanagerAppController extends AppController {
  var $components = array(
   'Session',
   'RequestHandler',
   'Amanager.Ctrl'
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

