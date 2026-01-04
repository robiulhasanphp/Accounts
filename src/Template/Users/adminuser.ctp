<div class="content_inner">

<div class="inner_box small">



<h4 class="inner_title"> Create System Admin User </h4>
<div style="clear:both"></div>

<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
         <?= $this->Form->input('USR_NAME') ?>
        <?= $this->Form->input('USR_PASS') ?>
         <?= $this->Form->input('USR_FULLNAME') ?>
         
        <?= $this->Form->input('BAS_TYPE_ID', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div></div></div>
