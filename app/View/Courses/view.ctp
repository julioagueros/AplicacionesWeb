<!-- File: /app/View/Courses/view.ctp -->

<h1>Name: <?php echo h($course['Course']['name']); ?></h1>
<p>Area: <?php echo h($course['Area']['name']); ?></p>
<p>User Owner Id : <?php echo h($course['Course']['user_id']); ?></p>

<h1> <?php echo $this->Form->postLink('SEE COURSEs NEWS FEED', 
			array('controller' =>'Feeds', 'action' => 'indexRelatedCourses', $course['Course']['id'])); ?> </h1>
&nbsp;
<h1> <?php echo $this->Form->postLink('SEE COURSEs ASSIGNMENTS', 
			array('controller' =>'Assignments', 'action' => 'indexAssignmentsofCourse', $course['Course']['id'])); ?> </h1>
&nbsp;
<h1> <?php echo $this->Form->postLink('SEE COURSEs FILES', 
			array('controller' =>'Resources', 'action' => 'indexResourcesofCourse', $course['Course']['id'])); ?> </h1>


<p><small>Created: <?php echo $course['Course']['created']; ?></small></p>
