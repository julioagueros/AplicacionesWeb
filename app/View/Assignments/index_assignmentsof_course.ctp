	<div class="assignments index">
	<h2><?php echo __('Assignments'); ?></h2>
	<table cellpadding="0" cellspacing="0">

    <tr>
        
        <th>Title</th>
	<th>Description</th>
        <th>Created</th>        
        <th>Course</th>
        <th>Actions</th>
    </tr>

	<?php
	foreach ($assignments as $assignment): ?>
	<tr>
		
		<td><?php echo h($assignment['Assignment']['title']); ?>&nbsp;</td>
		<td><?php echo h($assignment['Assignment']['description']); ?>&nbsp;</td>
		<td><?php echo h($assignment['Assignment']['created']); ?>&nbsp;</td>		
		<td>
			<?php echo $this->Html->link($assignment['Course']['name'], array('controller' => 'courses', 'action' => 'view', $assignment['Course']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assignment['Assignment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assignment['Assignment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assignment['Assignment']['id']), null, __('Are you sure you want to delete # %s?', $assignment['Assignment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Assignment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
