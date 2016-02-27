<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>  ' . __d('amanager', 'List users'), array('controller'=>'users', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>  ' . __d('amanager', 'Edit'), array('controller'=>'users', 'action' => 'edit', $user['User']['id']), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New User'), array('action' => 'add'), array('escape'=>false)); ?></li>
  <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>  ' . __('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('escape'=>false), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
</ul>
<br />
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Users'); ?></h3>
				<div class="box-tools pull-right">
					<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				</div>
			</div>

			<div class="box-body table-responsive">
				<table id="News" class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td><strong><?php echo __('Id'); ?></strong></td>
							<td>
								<?php echo h($user['User']['id']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Name'); ?></strong></td>
								<td>
									<?php echo h($user['User']['name']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Username'); ?></strong></td>
								<td>
									<?php echo h($user['User']['username']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Email'); ?></strong></td>
								<td>
									<?php echo h($user['User']['email']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Status'); ?></strong></td>
								<td>
									<span class="label label-default"><?php echo $user['User']['status']==1?__d('amanager', 'Active'):__d('amanager', 'Inactive'); ?></span>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Created'); ?></strong></td>
								<td>
									<?php echo h($user['User']['created']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Modified'); ?></strong></td>
								<td>
									<?php echo h($user['User']['modified']); ?>
									&nbsp;
								</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Related Groups'); ?></h3>
			</div>
			<?php if (!empty($user['Group'])): ?>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="80"><?php echo __('Id'); ?></th>
								<th><?php echo __('Name'); ?></th>
								<th width="80"><?php echo __('Status'); ?></th>
								<th><?php echo __('Created'); ?></th>
								<th><?php echo __('Modified'); ?></th>
								<th width="130"><?php echo __('Actions'); ?></th>
							</tr>
						</thead>
						<tbody>
								<?php
								$i = 0;
								foreach ($user['Group'] as $group): ?>
									<tr>
										<td><?php echo $group['id']; ?></td>
										<td><?php echo $group['name']; ?></td>
										<td><?php echo $group['status']; ?></td>
										<td><?php echo $group['created']; ?></td>
										<td><?php echo $group['modified']; ?></td>
										<td class="actions cancel">
											<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $group['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
											<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $group['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
											<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $group['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $group['id'])); ?>
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
