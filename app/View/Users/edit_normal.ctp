<!-- File: /app/View/Users/edit_normal.ctp -->

<h1>Edit User -Non administrator view-</h1>
<?php
    echo $this->Form->create('User', array('action' => 'edit'));
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->input('email');
    echo $this->Form->input('role', array('type' => 'hidden'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Changes');
