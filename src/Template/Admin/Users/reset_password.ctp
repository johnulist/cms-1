<?php
    $this->layout = false;
    $this->assign('title', 'Reset Your Password');
    echo $this->element('Admin/header');
?>

<div class="container">
    <div class="row">
        <?= $this->Flash->render(); ?>

        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title sign-in"><?php echo $this->Html->image('logo.png') ?></h3>
                </div>
                <div class="panel-body">
                    <?= $this->Form->create() ?>
                        <fieldset>
                            <h4>Please enter your new password</h4>

                            <?php
                                echo $this->Form->input('password', array('div' => 'form-group', 'class' => 'form-control', 'placeholder' => __('New Password'), 'label' => false));

                                echo $this->Form->input('password_confirm', array('div' => 'form-group', 'class' => 'form-control', 'placeholder' => __('Confirm Password'), 'label' => false, 'type' => 'password'));
                            ?>
                            <?php echo $this->Form->submit(__('Reset Password'), array('class' => 'btn btn-lg btn-success btn-block')); ?>

                            <div class="bottom-links">
                                <?php echo $this->Html->link(__('Return to the Login page'), array('action' => 'login')); ?>
                            </div>
                        </fieldset>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('Admin/footer'); ?>