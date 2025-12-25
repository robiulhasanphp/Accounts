

<div class="content_inner">


<div class="login_box" >

<p style="padding-left:12px; color:#030" align="right"><?php echo $this->Html->link("Register for New user ",
array('controller' => 'Users', 'action' => 'add')); ?></p>



<h3 style="padding-left:150px;margin-top:-10px;color:#CCC">Authentication</h3>

<!-- File: src/Template/Users/login.ctp -->

<div class="add_box" style="margin-top:22px;">
        <h5 style="padding-left:100px;text-align:right;color:#CCC;padding-bottom:20px;">Please enter your username and password</h5>

<?= $this->Form->create() ?>
    <fieldset>

        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Login', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div></div>