<!-- File: /app/View/Areas/index.ctp -->

<h1>TEC Blog</h1>

<?php echo $this->Html->link('Add Area', array('controller' => 'areas', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Name</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $areas array, printing out post info -->

    <?php foreach ($areas as $area): ?>
    <tr>
        <td><?php echo h($area['Area']['name']); ?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $area['Area']['id'])); ?> 
          | <?php echo $this->Form->postLink(
        	       'Delete',
        	        array('action' => 'delete', $area['Area']['id']),
        	        array('confirm' => 'Are you sure?'));
        	?>
        </td>

        <td><?php echo $area['Area']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($area); ?>
</table>
