<!-- File: /app/View/Homes/index.ctp -->

<h1>Bienvenido a la aplicación académica</h1>


<div class="manejo usuarios">
<dl>
<dt><p> Usuarios Nuevos: </p></dt>
<dd><?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add')); ?></dd>

&nbsp;
<dt><p> Ingresar a la Aplicación: </p></dt>
<dd><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?></dd>
&nbsp;
</dl>
</div>

<div class="sección administrativa">
<p>Sección Administrativa:</p>
<p><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('Courses', array('controller' => 'courses', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('Areas', array('controller' => 'areas', 'action' => 'index')); ?></p>
</div>


