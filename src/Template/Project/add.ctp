<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat Project </h4>
<div style="clear:both"></div>
<div class="add_box">

<?= $this->Form->create($Project) ?>


<hr />        
        <?= $this->Form->input('BAS_CODE', array(
            'label'=>'Project Code',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('BAS_NAME', array(
            'label'=>'Project Name',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('BAS_DESCRIPTION', array(
            'label'=>'Description',
			'type'=>'text'
        )); ?>
    
   </fieldset>
<?php 
  	echo '<div class="button">';
      echo $this->Form->button('Create', array('class'=>'custom_submit'));
  	echo '</div>';
  ?>
<?= $this->Form->end() ?>
</div></div>