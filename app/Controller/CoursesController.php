<?php
class CoursesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');



    public function isAuthorized($user) {


	//validacion para autorizar a profesores a añadir cursos	
	if ($this->action === 'add'){
		if($this->Auth->user('role') == 'profesor'){
			return true;
		}
	}
	//validación para que sólo los usuarios matriculados en el curso puedan ver la info del mismo.
	if ($this->action === 'view'){
	$courseId = $this->request->params['pass'][0];
		//$cantTuplasUserCourse = $this->Course->CoursesUser->find('count', array('conditions' => array('CoursesUser.user_id' => $this->Auth->user('id'), 'CoursesUser.course_id' => $this->request->params['pass'][0])));
		$cantTuplasUserCourse = $this->Course->CoursesUser2->find('count', array('conditions' => array('CoursesUser2.user_id' => $this->Auth->user('id'), 'CoursesUser2.course_id' => $courseId)));
		if($cantTuplasUserCourse > 0){
			return true;
		}
	}	
        if ($this->action === 'edit') {
	$courseId = $this->request->params['pass'][0];
	// Si el fue el que lo creo, lo puede editar
            if ($this->Course->isOwnedBy($courseId, $user['id'])) {
               return true;
            }
        }

	return parent::isAuthorized($user);	
    }

    public function index() {
        $this->set('courses', $this->Course->find('all', array(
        	'order' => array('Area.name' => 'asc'))));
    }
    
    public function view($id = null) {
        $this->Course->id = $id;
	if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course.'));
        }
        $this->set('course', $this->Course->read());
    }

    public function add() {
	//Si el request viene mediante post
        if ($this->request->is('post')) {
		//para agregar el id del usuario que crea el curso.
		$this->request->data['Course']['user_id'] = $this->Auth->user('id');
        	if ($this->Course->save($this->request->data)) {
                	$this->Session->setFlash('The course has been saved.');
                	$this->redirect(array('action' => 'index'));
		} else {
	                $this->Session->setFlash('Unable to add the course.');
		}
    	}
	
	$this->set('areas', $this->Course->Area->find('list'));
    }

     public function edit($id = null) {
	$this->Course->id = $id;
        if (!$this->Course->exists()) {
            throw new NotFoundException(__('Invalid course'));
        }
	if ($this->request->is('get')) {
	        $this->request->data = $this->Course->read();
		$this->set('areas', $this->Course->Area->find('list'));
	} else {
		if ($this->Course->save($this->request->data)) {
			$this->Session->setFlash('The course has been updated.');
		        $this->redirect(array('action' => 'index'));
        	} else {
			$this->Session->setFlash('Unable to update the course.');
        	}
    	}


    }


	public function delete($id) {
		$this->Course->id = $id;
		//****************NOMBRES EXTRAÑOS****************************
		$nombreDeColumna = $this->Course->field('name');
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Course->delete($id)) {
			$this->Course->id = $id;
			$this->Session->setFlash('The course ' . $nombreDeColumna . ' has been deleted');
			$this->redirect(array('action' => 'index'));
		}
	}

	/*public function addstudent($id){
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Course->id = $id;
		$this->request->data['User']['user_id'] = $this->Auth->user('id');
		$this->Course->UserOf = $this->Auth->user;
		$courseName = $this->Course->field('name');
		
		if ($this->Course->save()){
			$this->Session->setFlash('The course ' . $courseName . ' has been added to your account');
			$this->redirect(array('action' => 'index'));
		} else {
	                $this->Session->setFlash('Unable to add the course.');
		}
		
	}*/

}

