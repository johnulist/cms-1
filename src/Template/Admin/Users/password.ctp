<?php
    $this->assign('title', 'Edit My Password');
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit My Password</h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= __('Category Details');?>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($user) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('current_password', ['type' => 'password', 'class' => 'form-control', 'value' => false]);
                    echo $this->Form->input('password', ['class' => 'form-control', 'label' => __('New Password'), 'value' => false]);
                    echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control', 'label' => __('Confirm Password'), 'value' => false]);

                    echo $this->Form->submit(__('Update Password'), ['class' => 'btn btn-primary']);
                ?>
            </fieldset>
        <?= $this->Form->end();?>
    </div>
</div>