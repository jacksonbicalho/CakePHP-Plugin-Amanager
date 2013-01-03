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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title> <?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css(
                         array(
                           '/amanager/css/TwitterBootstrap/bootstrap.min',
                           '/amanager/css/TwitterBootstrap/bootstrap-responsive.min',
                           '/amanager/css/style',
                         )
                       );
    echo $this->Html->script(
            array(
                '/amanager/js/jquery/jquery-1.7.2.min',
                '/amanager/js/jquery/plugins/jquery-ui-1.8.21.custom.min',
                '/amanager/js/TwitterBootstrap/bootstrap.min',
            )
    );
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
  </head>
  <body>
    <?php echo $this->element('navbar-fixed-top'); ?>
    <div id="main" class="container">
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
      <hr />
      <footer>
        <div class="vcard">
          <span class="fn org">Organização</span>
          <div class="adr">
            <span class="street-address">Endereço</span>,
            <span class="locality">Rio de Janeiro</span> / <abbr title="Rio de Janeiro" class="region">RJ</abbr>,
            <span class="country-name">Brasil</span>
          </div>
          <div>
            <span class="email">contato@email.com.br</span> -
            <span class="url">http://www.site.com.br/</span>
          </div>
        </div>
      </footer>
    </div>
<?php echo $this->Js->writeBuffer(); ?>
  </body>
</html>