<!-- File: /app/View/CoursesUser/add.ctp -->

<h1>Add Course</h1>
<?php
	echo $this->Form->create('CoursesUser');
	echo $this->Form->input('course_id', array('label'=>'Course'));
	echo $this->Form->input('user_id', array('label'=>'Student'));
	echo $this->Form->end('Enroll Student');
?>
