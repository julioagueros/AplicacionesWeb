<!-- File: /app/View/Courses/index.ctp -->

<h1>Courses</h1>

<?php echo $this->Html->link('Add Course', array('controller' => 'courses', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Name</th>
        <th>Area</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <?php foreach ($courses as $course): ?>
    <tr>
        <td><?php echo $this->html->link($course['Course']['name'], array('controller' => 'courses', 'action' => 'view', $course['Course']['id'])); ?></td>
	<td><?php echo h($course['Area']['name']); ?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $course['Course']['id'])); ?> 
          | <?php echo $this->Form->postLink(
        	       'Delete',
        	        array('action' => 'delete', $course['Course']['id']),
        	        array('confirm' => 'Are you sure?'));
        	?>

	  | <?php echo $this->Form->postLink(
        	       'Enroll to Course',
        	        array('controller' => 'CoursesUser', 'action' => 'enrollToCourse', $course['Course']['id']),
			array('confirm' => 'Are you sure?'));
        	?>
        </td>

        <td><?php echo $course['Course']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($course); ?>
</table>
