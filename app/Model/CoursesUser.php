<?php
class CoursesUser extends AppModel {

    public $name = 'CoursesUser';

	//Manera en que se agrega las foreign keys.
	public $belongsTo = array(
		'Course' => array(
			'className'    => 'Course',
			'foreignKey'    => 'course_id'
		),

		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
		
	);




	

}
