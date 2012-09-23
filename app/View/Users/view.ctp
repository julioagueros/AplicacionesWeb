<!-- File: /app/View/Users/view.ctp -->

<h1>Username: <?php echo h($user['User']['username']); ?></h1>
<h1>Email: <?php echo h($user['User']['email']); ?></h1>
<h1>Role: <?php echo h($user['User']['role']); ?></h1>

<p><small>Created: <?php echo $user['User']['created']; ?></small></p>

