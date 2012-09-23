<?php
class AreasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


    public function index() {
        $this->set('areas', $this->Area->find('all'));
    }

    public function add() {
	//Si el request viene mediante post
        if ($this->request->is('post')) {
        	if ($this->Area->save($this->request->data)) {
                	$this->Session->setFlash('The area has been saved.');
                	$this->redirect(array('action' => 'index'));
		} else {
	                $this->Session->setFlash('Unable to add the area.');
		}
    	}
    }

     public function edit($id = null) {
	$this->Area->id = $id;
	if ($this->request->is('get')) {
	        $this->request->data = $this->Area->read();
	} else {
		if ($this->Area->save($this->request->data)) {
			$this->Session->setFlash('The area has been updated.');
		        $this->redirect(array('action' => 'index'));
        	} else {
			$this->Session->setFlash('Unable to update the area.');
        	}
    	}
    }


	public function delete($id) {
		$this->Area->id = $id;
		$nombreDeColumna = $this->Area->field('name');
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Area->delete($id)) {
			$this->Area->id = $id;
			$this->Session->setFlash('The area ' . $nombreDeColumna . ' has been deleted');
			$this->redirect(array('action' => 'index'));
		}
	}

}

