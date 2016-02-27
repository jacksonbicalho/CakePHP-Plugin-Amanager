
<ul class="nav nav-justified">
  <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>  ' . __('Delete'), array('action' => 'delete', $group['Group']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?></li>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Groups'), array('controller' => 'groups', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'Edit this group'), array('controller' => 'groups', 'action' => 'edit', $group['Group']['id']), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Users'), array('controller' => 'users', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('controller' => 'users', 'action' => 'add'), array('escape'=>false)); ?>
</ul>
<br />

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Group'); ?></h3>
				<div class="box-tools pull-right">
					<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $group['Group']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				</div>
			</div>

			<div class="box-body table-responsive">
				<table id="News" class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td><strong><?php echo __('Id'); ?></strong></td>
							<td>
								<?php echo h($group['Group']['id']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Name'); ?></strong></td>
								<td>
									<?php echo h($group['Group']['name']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td><strong><?php echo __('Status'); ?></strong>
						<td>
							<span class="label label-default">
								<?php echo $group['Group']['status']==1?__d('amanager', 'Active'):__d('amanager', 'Inactive'); ?></span>
							&nbsp;
						</td>
						<tr>
							<td>
								<strong><?php echo __('Created'); ?></strong></td>
								<td>
									<?php echo h($group['Group']['created']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Modified'); ?></strong>
							</td>
							<td>
								<?php echo h($group['Group']['modified']); ?>
								&nbsp;
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Related Users'); ?></h3>
				<div class="box-tools pull-right">
					<?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				</div><!-- /.actions -->
			</div>
			<?php if (!empty($group['User'])): ?>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center"><?php echo __('Id'); ?></th>
								<th class="text-center"><?php echo __('Title'); ?></th>
								<th class="text-center"><?php echo __('Slug'); ?></th>
								<th class="text-center"><?php echo __('Description'); ?></th>
								<th class="text-center"><?php echo __('Created'); ?></th>
								<th class="text-center"><?php echo __('Modified'); ?></th>
								<th class="text-center"><?php echo __('Actions'); ?></th>
							</tr>
						</thead>
						<tbody>
								<?php
								$i = 0;
								foreach ($group['User'] as $user): ?>
									<tr>
										<td class="text-center"><?php echo $user['id']; ?></td>
										<td class="text-center"><?php echo $user['username']; ?></td>
										<td class="text-center"><?php echo $user['password']; ?></td>
										<td class="text-center"><?php echo $user['status']; ?></td>
										<td class="text-center"><?php echo $user['created']; ?></td>
										<td class="text-center"><?php echo $user['modified']; ?></td>
										<td class="text-center">
											<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('controller' => 'users', 'action' => 'view', $user['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
											<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
											<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $user['id'])); ?>
										</td>
									</tr>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>