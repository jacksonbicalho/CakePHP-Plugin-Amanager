
<ul class="nav nav-justified">
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'List Rules'), array('controller' => 'rules', 'action' => 'index'), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>  ' . __d('amanager', 'Edit this rule'), array('controller' => 'rules', 'action' => 'edit', $rule['Rule']['id']), array('escape'=>false)); ?>
  <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>  ' . __d('amanager', 'New Rule'), array('controller' => 'rules', 'action' => 'add'), array('escape'=>false)); ?>
  <li><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>  ' . __('Delete'), array('action' => 'delete', $rule['Rule']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $rule['Rule']['id'])); ?></li>
</ul>
<br />
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Rules'); ?></h3>
				<div class="box-tools pull-right">
					<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $rule['Rule']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				</div>
			</div>

			<div class="box-body table-responsive">
				<table id="News" class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td><strong><?php echo __('Id'); ?></strong></td>
							<td>
								<?php echo h($rule['Rule']['id']); ?>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo __('Name'); ?></strong></td>
								<td>
									<?php echo h($rule['Rule']['name']); ?>
									&nbsp;
								</td>
						</tr>
						<tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Rule Actions'); ?></h3>
			</div>
			<?php if (!empty($rule['Action'])): ?>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="80"><?php echo __('Id'); ?></th>
								<th><?php echo __('Alias'); ?></th>
								<th width="80" class="text-center"><?php echo __('Status'); ?></th>
							</tr>
						</thead>
						<tbody>
								<?php
								$i = 0;
								foreach ($rule['Action'] as $action): ?>
									<tr>
										<td><?php echo $action['id']; ?></td>
										<td><h4><span class="label label-info"><?php echo $action['alias']; ?></span></h4></td>
										<td class="text-center"><?php echo ($action['alow']) ? '<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span> ': '<span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span>'; ?></td>
									</tr>
								<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>