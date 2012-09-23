<!-- File: /app/View/Courses/edit.ctp -->

<h1>Edit Course</h1>
<?php
    echo $this->Form->create('Course', array('action' => 'edit'));
    echo $this->Form->input('name');
    echo $this->Form->input('area_id', array('label'=>'Area'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Course');
?>
