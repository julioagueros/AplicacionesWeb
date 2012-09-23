<div class="resources view">
<h2><?php  echo __('Resource'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resource['Course']['name'], array('controller' => 'courses', 'action' => 'view', $resource['Course']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Resource'), array('action' => 'edit', $resource['Resource']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Resource'), array('action' => 'delete', $resource['Resource']['id']), null, __('Are you sure you want to delete # %s?', $resource['Resource']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
