<?php
// Define o ítem ativo do menu
$menu['Amanager']['class'] = 'Amanager';
$menu['Users']['class'] = 'Users';
$menu['Groups']['class'] = 'Groups';
$menu['Rules']['class'] = 'Rules';
if(isset($menu[$this->name])) $menu[$this->name]['class'] .= ' active';
?>

<nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
  <?php if ($this->Amanager->is_logged()){ ?>
    <ul class="nav navbar-nav">

      <li class="<?php echo $menu['Users']['class']; ?>">
        <?php $this->Amanager->link(
          __('Manager Users'),
          array(
            'controller'=>'users',
            'action'=>'index',
            'plugin'=>false,
            'admin'=>true
          )
        ); ?>
      </li>

      <li class="<?php echo $menu['Groups']['class']; ?>">
        <?php echo $this->Html->link(
          __('Manager Groups', true),
          array(
            'controller'=>'groups',
            'action'=>'index',
            'plugin'=>false,
            'admin'=>true
          )
        ); ?>
      </li>

      <li class="<?php echo $menu['Rules']['class']; ?>">
        <?php echo $this->Html->link(
          __('Manger Rules', true),
          array(
            'controller'=>'rules',
            'action'=>'index',
            'plugin'=>false,
            'admin'=>true
          )
        ); ?>
      </li>
    </ul>
  <?php } ?>

  <?php if ($this->Amanager->is_logged()){ ?>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <img class="img-circle" src="<?=$this->Amanager->get_gravatar($this->Amanager->get_user_info('email'));?>"/>
          <?php echo $this->Amanager->get_user_info('email'); ?>
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li class="divider"></li>
          <li><?php echo $this->Html->link(__('Logout'), array('plugin'=>'amanager','controller'=> 'users', 'action'=>'logout')); ?></li>
        </ul>
      </li>
    </ul>
  <?php } ?>


</nav>