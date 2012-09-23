<?php
class Post extends AppModel {

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
	    'message' => 'No sea tontón, esto no puede ser vacío'
        )/*,
        'body' => array(
            'rule' => array('between', 1, 30),
	    'message' => 'Esto debe estar entre 1 y 30 caracteres'
        )*/
    );
}
