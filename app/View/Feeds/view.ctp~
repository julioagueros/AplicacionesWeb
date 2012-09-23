<div class="feeds view">
<h2><?php  echo __('Feed'); ?></h2>
	
	<ul>
<?php foreach($feed as $temp_item){
		echo "<li><a href=" . $temp_item['link'] . ">" . $temp_item['title'] . "</a></li><br>";
	}

?>
	</ul>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feeds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
	</ul>
</div>
