<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php echo $this->Html->link('Amanager', array('controller'=>'admin', 'action'=>'index', 'admin'=>false, 'plugin'=>false),array('class'=>'navbar-brand', 'title'=>'Serp FIP', 'escape'=>false));?>
	</div>

	<?php if ($this->Amanager->is_logged()): ?>
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->Amanager->get_user_info('name');?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li>
						<?php
							echo $this->Html->link('<i class="fa fa-fw fa-power-off"></i> Log Out',	array('controller'=> 'users',	'action'=>'logout',	'plugin'=>'amanager'),
							array('escape' => false, 'title' => 'Log Out'));
						?>
					</li>
				</ul>
			</li>
		</ul>
	<?php endif; ?>
	<?php echo $this->element("menu_sidebar"); ?>
</nav>
