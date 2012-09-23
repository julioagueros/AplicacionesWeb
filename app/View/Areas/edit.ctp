<!-- File: /app/View/Areas/edit.ctp -->

<h1>Edit Area</h1>
<?php
    echo $this->Form->create('Area', array('action' => 'edit'));
    echo $this->Form->input('name');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Area');
?>
