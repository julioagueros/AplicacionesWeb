<!-- app/View/Users/addAdmin.ctp -->
<div class="users form">
<?php echo $this->Form->create('User', array('action' => 'addAdmin')); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('administrador' => 'Admininistrador', 'profesor' => 'Profesor', 'estudiante' => 'Estudiante')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Add User')); ?>
</div>
