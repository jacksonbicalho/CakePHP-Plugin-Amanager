<?php
// Define o ítem ativo do menu
$menu['Amanager']['class'] = 'Amanager';
$menu['Users']['class'] = 'Users';
$menu['Groups']['class'] = 'Groups';
$menu['Rules']['class'] = 'Rules';
if(isset($menu[$this->name]))
  $menu[$this->name]['class'] .= ' active';
?>

<?php echo $this->Html->script('jquery/plugins/bootstrap-dropdown', array('inline' => false)); // Include jQuery library  ?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link( __('Acess Manager', true), array('controller'=>'amanager', 'action'=>'index', 'plugin'=>'amanager'), array('class'=>'brand ' . $menu['Amanager']['class'] )); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php echo $menu['Users']['class']; ?>">
                <?php echo $this->Html->link( __('Manager Users', true), array('controller'=>'users', 'action'=>'index', 'plugin'=>'amanager')); ?>
              </li>
              <li class="<?php echo $menu['Groups']['class']; ?>">
                <?php echo $this->Html->link( __('Manager Groups', true), array('controller'=>'groups', 'action'=>'index', 'plugin'=>'amanager')); ?>
              </li>
              <li class="<?php echo $menu['Rules']['class']; ?>">
                <?php echo $this->Html->link( __('Manger Rules', true), array('controller'=>'rules', 'action'=>'index', 'plugin'=>'amanager')); ?>
              </li>
            </ul>
            <?php if ($this->Amanager->is_logged()){ ?>
              <ul class="nav pull-right">
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Amanager->get_user_info('email'); ?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li><?php echo $this->Html->link(__('Logout'), array('plugin'=>'amanager','controller'=> 'users', 'action'=>'logout')); ?></li>
                  </ul>
                </li>
              </ul>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
