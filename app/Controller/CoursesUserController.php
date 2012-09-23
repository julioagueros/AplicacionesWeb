<?php
class CoursesUserController extends AppController {

    public function beforeFilter() {
        //parent::beforeFilter();
        
    }

    public function isAuthorized($user) {

	//validacion para autorizar a profesores a añadir cursos	
	if ($this->action === 'add'){
		if($this->Auth->user('role') == 'profesor'){
			return true;
		}
	}
	// Si es estudiante se puede matricular en el curso
        if ($this->action === 'enrollToCourse') {
            if($this->Auth->user('role') == 'estudiante'){
			return true;
		}
        }

	return parent::isAuthorized($user);	
    }
	
	public function index() {
	        $this->set('coursesUser', $this->CoursesUser->find('all'));
	}
		

	/*public function add($id = null){
		$this->CoursesUser->course_id = $id;
		//Si el request viene mediante post
        	if ($this->request->is('post')) {
			//$this->request
		}
	}*/

	public function add() {
		//Si el request viene mediante post
	        if ($this->request->is('post')) {
			//para agregar el id del usuario que crea el curso.
	        	if ($this->CoursesUser->save($this->request->data)) {
	                	$this->Session->setFlash('The student has been enrolled in the course');
	                	$this->redirect(array('action' => 'index'));
			} else {
		                $this->Session->setFlash('Unable to add the course.');
			}
	    	}
	
		$this->set('courses', $this->CoursesUser->Course->find('list'));
		if ($this->Auth->user('role') === 'profesor'){
			$this->set('users', $this->CoursesUser->User->find('list', array('conditions'=>array('role'=>'estudiante'))));
		}else{
			$this->set('users', $this->CoursesUser->User->find('list'));
		}
		
    	}

	//Funcion para matricularse a un curso. Esta debería funcionar sólo si se es estudiante.
	public function enrollToCourse($id = null) {
		//Si el request viene mediante post
	        if ($this->request->is('post')) {
			//para agregar el id del usuario que crea el curso.
			$this->request->data['CoursesUser']['course_id'] = $id;
			$this->request->data['CoursesUser']['user_id'] = $this->Auth->user('id');
			
	        	if ($this->CoursesUser->save($this->request->data)) {
	                	$this->Session->setFlash('The student has been enrolled in the course');
	                	$this->redirect(array('action' => 'index'));
			} else {
		                $this->Session->setFlash('Unable to add the course1.');
			}
	    	}
	
		
    	}


}


