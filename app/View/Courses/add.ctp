<!-- File: /app/View/Courses/add.ctp -->

<h1>Add Course</h1>
<?php
	echo $this->Form->create('Course');
	echo $this->Form->input('name');
	echo $this->Form->input('area_id', array('label'=>'Area'));
	//echo $this->Form->input('areas');
	//echo $this->Form->input('Area.id',         
	//	array('type'=>'hidden'));
	echo $this->Form->end('Save Course');
?>
