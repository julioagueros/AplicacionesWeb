<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//componentes para poder lograr la autenticacion
	public $components = array(
		'Session',
	        'Auth' => array(
			//CAMBIAR ESTO POR LOS CONTROLLERS QUE SE NECESITAN...
			'loginRedirect' => array('controller' => 'courses', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'home', 'action' => 'index'),
			'authorize' => array('Controller') //linea para hacer que pida auth en los controllers			
	        	)
	    	);

	//permitir que se pueda ver el index y el view sin loggearse (COMENTADO PORQUE NO SE DEBE PERMITIR EN TODOS LOS CONTROLADORES)	
	public function beforeFilter() {
	//       $this->Auth->allow('index', 'view');
		$this->Auth->allow('index');
	}
	

	public function isAuthorized($user) {
	    // Administrador puede acceder a todas las operaciones
		if (isset($user['role']) && $user['role'] === 'administrador') {
        		return true;
    		}

	    // Default deny
		return false;
	}
}
