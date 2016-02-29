<?php if ($this->Amanager->is_logged()): ?>
<?php
// Define o ítem ativo do menu
$menu['Amanager']['class'] = 'Amanager';
$menu['Users']['class'] = 'Users';
$menu['Groups']['class'] = 'Groups';
$menu['Rules']['class'] = 'Rules';
if(isset($menu[$this->name])) $menu[$this->name]['class'] .= ' active';
?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
		<li>
			<?php echo $this->Html->link('<i class="fa fa-fw fa-dashboard"></i> Dashboard', array('controller'=>'amanager', 'action'=>'amanager', 'admin'=>true, 'plugin'=>false),array('title'=>'', 'escape'=>false));?>
		</li>
		<li class="<?php echo $menu['Users']['class']; ?>">
			<?php echo $this->Html->link(
				__('<i class="fa fa-fw fa-table"></i> Manager Users', true),
				array(
					'controller'=>'users',
					'action'=>'index',
					'plugin'=>'amanager',
					'admin'=>true
				), array('escape'=>false)
			); ?>
		</li>
		<li class="<?php echo $menu['Groups']['class']; ?>">
			<?php echo $this->Html->link(
				__('<i class="fa fa-fw fa-table"></i> Manager Groups', true),
				array(
					'controller'=>'groups',
					'action'=>'index',
					'plugin'=>'amanager',
					'admin'=>true
				), array('escape'=>false)
			); ?>
		</li>
		<li class="<?php echo $menu['Rules']['class']; ?>">
			<?php echo $this->Html->link(
				__('<i class="fa fa-fw fa-table"></i> Manger Rules', true),
				array(
					'controller'=>'rules',
					'action'=>'index',
					'plugin'=>'amanager',
					'admin'=>true
				), array('escape'=>false)
			); ?>
		</li>
	</ul>
</div>
<!-- /.navbar-collapse -->
<?php endif; ?>