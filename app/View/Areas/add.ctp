<!-- File: /app/View/Areas/add.ctp -->

<h1>Add Area</h1>
<?php
	echo $this->Form->create('Area');
	echo $this->Form->input('name');
	echo $this->Form->end('Save Area');
?>
