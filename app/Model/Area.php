<?php
class Area extends AppModel {
    
    public $name = 'Area';
    //public $displayField = 'name';
    //Parte de binding model to model (foreign keys)
    public $hasMany = array(
        'Course' => array(
            'className'    => 'Course',
            'foreignKey'    => 'area_id'
         )
    );

    //Validaciones para longitud y no vacio.
    public $validate = array(
        'name' => array(
		'length' => array(
		    'rule' => array('maxLength', 30),
		    'message' => "The area's name must be no larger than 30 characters long."
		),
		'required' => array(
			'rule' => array('notEmpty'),
                	'message' => "The areas's name is required"
		)
	)
    );

}
