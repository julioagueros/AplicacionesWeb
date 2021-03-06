<?php
App::uses('AppController', 'Controller');
/**
 * Resources Controller
 *
 * @property Resource $Resource
 * @property SessionComponent $Session
 */
class ResourcesController extends AppController {

    public function beforeFilter() {
        //parent::beforeFilter();
        
    }

    public function isAuthorized($user) {

	//validacion para autorizar a profesores a añadir cursos	
	if ($this->action === 'add' || $this->action === 'edit'){
		if($this->Auth->user('role') == 'profesor'){
			return true;
		}
	}
	// se puede ver indexResourcesofCourse
        if ($this->action === 'indexResourcesofCourse' || $this->action === 'view' || $this->action === 'download') {
        	return true;
		
        }

	return parent::isAuthorized($user);	
    }



/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Session');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Resource->recursive = 0;
		$this->set('resources', $this->paginate());
	}


/**
 * indexResourcesofCourse method
 * Método para mostrar sólo los recursos relacionados a un curso.
 * 
 * Recibe el id del course del que se buscan los recursos.
 *
 * @return void
 */
	public function indexResourcesofCourse($id = null) {
		if ($this->request->is('post')) {
		$courseResources = $this->Resource->find('all', array(
			'conditions' => array('Resource.course_id' => $id)));
		$this->set('resources', $courseResources);

		} else{
			$this->Session->setFlash('The action is not permitted.');
		}
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Resource->id = $id;
		if (!$this->Resource->exists()) {
			throw new NotFoundException(__('Invalid resource'));
		}
		$this->set('resource', $this->Resource->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Resource->create();
			//Acá se lee la información desde el campo 'data' de la vista
			$fileData = fread(fopen($this->request->data['Resource']['data']['tmp_name'], "r"), 
                                     $this->data['Resource']['data']['size']);
			//Se toma información del archivo gracias a campo de tipo file en la vista
   			$this->request->data['Resource']['title'] = $this->request->data['Resource']['data']['name'];
            		$this->request->data['Resource']['data'] = $fileData;
			if ($this->Resource->save($this->request->data)) {
				$this->Session->setFlash(__('The resource has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resource could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Resource->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Resource->id = $id;
		if (!$this->Resource->exists()) {
			throw new NotFoundException(__('Invalid resource'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Resource->save($this->request->data)) {
				$this->Session->setFlash(__('The resource has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The resource could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Resource->read(null, $id);
		}
		$courses = $this->Resource->Course->find('list');
		$this->set(compact('courses'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Resource->id = $id;
		if (!$this->Resource->exists()) {
			throw new NotFoundException(__('Invalid resource'));
		}
		if ($this->Resource->delete()) {
			$this->Session->setFlash(__('Resource deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Resource was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	//funcion para bajar el archivo que representa Resources
	public function download($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		Configure::write('debug', 0);
		$file = $this->Resource->findById($id);
		
		//header('Content-type: ' . $file['MyFile']['type']);
//		header('Content-length: ' . $file['MyFile']['size']); // some people reported problems with this line (see the comments), 			commenting out this line helped in those cases
		header('Content-Disposition: attachment; filename="'.$file['Resource']['title'].'"');
		echo $file['Resource']['data'];
			
		exit();
}
}


