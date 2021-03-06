<?php
App::uses('AppController', 'Controller');
/**
 * Feeds Controller
 *
 * @property Feed $Feed
 * @property SessionComponent $Session
 */
class FeedsController extends AppController {


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
        if ($this->action === 'indexRelatedCourses' || $this->action === 'view') {
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
		$this->Feed->recursive = 0;
		$this->set('feeds', $this->paginate());
	}


/**
 * indexRelatedCourses method
 * Método para mostrar sólo los feeds relacionados a un curso.
 * 
 * Recibe el id del course del que se buscan los feeds.
 *
 * @return void
 */
	public function indexRelatedCourses($id = null) {
		if ($this->request->is('post')) {
		$courseFeeds = $this->Feed->find('all', array(
			'conditions' => array('Feed.course_id' => $id)));
		$this->set('feeds', $courseFeeds);

		} else{
			$this->Session->setFlash('The action is not permitted.');
		}
		
	}

/**
 * view method
 * Acá es donde se trabaja lo que es el XML que es el RSS
 
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		//App::import('Xml');
		$this->Feed->id = $id;
		if (!$this->Feed->exists()) {
			throw new NotFoundException(__('Invalid feed'));
		}
		$parsed_xml = Xml::build($this->Feed->field('url'));
		// convertir xml a array
		$rss_item = array();
		$this->rss_item = Xml::toArray($parsed_xml);

		//los archivos rss tienen una estructura de xml igual, justamente para poder leerlos.
		$this->set('feed', $this->rss_item['rss']['channel']['item']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Feed->create();
			if ($this->Feed->save($this->request->data)) {
				$this->Session->setFlash(__('The feed has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feed could not be saved. Please, try again.'));
			}
		}
		$courses = $this->Feed->Course->find('list');
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
		$this->Feed->id = $id;
		if (!$this->Feed->exists()) {
			throw new NotFoundException(__('Invalid feed'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feed->save($this->request->data)) {
				$this->Session->setFlash(__('The feed has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feed could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Feed->read(null, $id);
		}
		$courses = $this->Feed->Course->find('list');
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
		$this->Feed->id = $id;
		if (!$this->Feed->exists()) {
			throw new NotFoundException(__('Invalid feed'));
		}
		if ($this->Feed->delete()) {
			$this->Session->setFlash(__('Feed deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Feed was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
