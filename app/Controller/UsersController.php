<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function isAuthorized($user) {
        if ($this->action === 'edit') {
               $userId = $this->request->params['pass'][0]; //params agarra el primer param despues de la accion en el URL.
            if ($this->User->isItself($userId, $user['id'])) {
               return true;
            }
        }
	
        return parent::isAuthorized($user);
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
	//Si el usuario es administrador, lo envia a la funcion que le corresponde para asignar roles.
	if ($this->Auth->user('role') == 'administrador'){
		return ($this->redirect(array('action' => 'addAdmin')));
	}
        if ($this->request->is('post')) {
            $this->User->create();
	    $this->request->data['User']['role'] = 'estudiante';
            if ($this->User->save($this->request->data)) {
		//logica para enviar un correo a el nuevo usuario:	
		$email = new CakeEmail('yahoo');
		$email->from(array('aplicacionesweb@yahoo.com' => 'Aplicacion Academica'));
		$email->to($this->request->data['User']['email']);
		$email->subject('Bienvenido a la Aplicacion Academica');
		$email->send('Usted, ' . $this->request->data['User']['username'] . 'se ha registrado en la mejor aplicacion academica que hay. Sea feliz.

Saludos, equipo de Aplicaciones academicas.');

                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }
	//funcion de add user para los usuarios que son administradores.
    public function addAdmin() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {

		//logica para enviar un correo a el nuevo usuario:
		$email = new CakeEmail('yahoo');
		$email->from(array('aplicacionesweb@yahoo.com' => 'Aplicacion Academica'));
		$email->to($this->request->data['User']['email']);
		$email->subject('Bienvenido a la Aplicacion Academica');
		$email->send('Usted, ' . $this->request->data['User']['username'] . 'se ha registrado en la mejor aplicacion academica que hay. Sea feliz.

Saludos, equipo de Aplicaciones academicas.');
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }	
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }

	//Si no es una administrador, entonces le muestra una vista en la que no puede cambiar su rol.
	if ($this->Auth->user('role') != 'administrador'){
		$this->render('edit_normal');
	}
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }


	//funciones Login y logout.

	public function login() {
		if ($this->request->is('post')) {
        		if ($this->Auth->login()) {
        		    $this->redirect($this->Auth->redirect());
        		} else {
        		    $this->Session->setFlash(__('Invalid username or password, try again'));
        		}
    		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}	
