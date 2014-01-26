<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Jackson Bicalho - jacksonbicalho@gmail.com">
    <title> <?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css(
                         array(
                           '/amanager/css/bootstrap.min',
                           '/amanager/css/bootstrap-theme.min',
                           '/amanager/css/style',
                         )
                       );
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php
    echo $this->Html->script(
            array(
                '/amanager/js/jquery/jquery-1.7.2.min',
                '/amanager/js/jquery/plugins/jquery-ui-1.8.21.custom.min',
                '/amanager/js/bootstrap.min',
            )
    );
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
  </head>
  <body>
    <?php echo $this->element('header'); ?>
      <div id='main' class="container">
        <div class="row row-offcanvas row-offcanvas-right">
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
        </div>
      </div>
    <?php echo $this->element('footer'); ?>
    <?php echo $this->Js->writeBuffer(); ?>
  </body>
</html>