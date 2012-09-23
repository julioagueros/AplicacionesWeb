	<div class="resources index">
	<h2><?php echo __('Resources'); ?></h2>
	<table cellpadding="0" cellspacing="0">

    <tr>
        
        <th>Title</th>
	<th>Description</th>
        <th>Created</th>        
        <th>Course</th>
        <th>Actions</th>
    </tr>

	<?php
	foreach ($resources as $resource): ?>
	<tr>
		
		<td><?php echo h($resource['Resource']['title']); ?>&nbsp;</td>
		<td><?php echo h($resource['Resource']['description']); ?>&nbsp;</td>
		<td><?php echo h($resource['Resource']['created']); ?>&nbsp;</td>		
		<td>
			<?php echo $this->Html->link($resource['Course']['name'], array('controller' => 'courses', 'action' => 'view', $resource['Course']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Download'), array('action' => 'download', $resource['Resource']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $resource['Resource']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $resource['Resource']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $resource['Resource']['id']), null, __('Are you sure you want to delete # %s?', $resource['Resource']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Resource'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
