<?php
class Course extends AppModel {

    public $name = 'Course';
    //Manera en que se agrega las foreign keys a la vista
    public $belongsTo = array(
        'Area' => array(
            'className'    => 'Area',
            'foreignKey'    => 'area_id'
         )
    );

	//para ligarlo con users.
	public $hasMany = array(
		'CoursesUser2' => array (
			'className' => 'CoursesUser',
			'foreignKey'    => 'course_id'),
		'Assignments' => array(
			'className' => 'Assignment',
			'foreignKey' => 'course_id'),

		'Resources' => array(
			'className' => 'Resource',
			'foreignKey' => 'course_id'),
		'Feeds' => array(
			'className' => 'Feed',
			'foreignKey' => 'course_id')

		);

	/*/Para ligarlo con Users.
	public $hasAndBelongsToMany = array(
		'UserOf' =>
			array(
	                	'className'              => 'User',
		                'joinTable'              => 'courses_users',
		                'foreignKey'             => 'course_id',
		                'associationForeignKey'  => 'user_id',
		                'unique'                 => true
			)
		);

	*/

    //Validaciones para que el nombre del curso no este vacío
    public $validate = array(
        'name' => array(
		'length' => array(
		    'rule' => array('maxLength', 50),
		    'message' => "The course's name must be no larger than 50 characters long."
		),
		'required' => array(
			'rule' => array('notEmpty'),
                	'message' => "The course's name is required"
		)
	)
    );

	//funcion para saber si el usuario que esta activo es el mismo que se pregunta en el parámetro
	//el param $user es el id del user, se compara contra el user_id de $courseURL que es el que se está intentando editar.
	public function isOwnedBy ($courseURL, $user){
		return $this->field('user_id', array('id' => $courseURL)) === $user;
	}



}
