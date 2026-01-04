<!-- src/Template/Users/add.ctp -->
<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Creat Coaset </h4>
<div style="clear:both"></div>
<div class="proj_dep">

<?= $this->Form->create($Coaset) ?>


<hr />        
        <?= $this->Form->input('SET_NAME', array(
            'label'=>'SET NAME',
			'type'=>'text'
        )); ?>
        <?= $this->Form->input('SET_DESCRIPTION', array(
            'label'=>'SET DESCRIPTION',
			'type'=>'text'
        )); ?>
		<?= $this->Form->input('SET_CODE', array(
            'label'=>'SET CODE',
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


<p style="width:10px; font-size:8px; font-family:Georgia, 'Times New Roman', Times, serif"></p>