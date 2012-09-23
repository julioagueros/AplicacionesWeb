<div class="assignments view">
<h2><?php  echo __('Assignment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assignment['Assignment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($assignment['Assignment']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($assignment['Assignment']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assignment['Assignment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assignment['Course']['name'], array('controller' => 'courses', 'action' => 'view', $assignment['Course']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assignment'), array('action' => 'edit', $assignment['Assignment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assignment'), array('action' => 'delete', $assignment['Assignment']['id']), null, __('Are you sure you want to delete # %s?', $assignment['Assignment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assignments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assignment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
