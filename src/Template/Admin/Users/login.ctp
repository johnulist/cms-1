<?php
	$this->layout = false;
	$this->assign('title', 'Login');
	echo $this->element('Admin/header');
?>

<div class="container">
	<div class="row">
		<?= $this->Flash->render(); ?>
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title sign-in"><?= $this->Html->image('logo.png') ?></h3>
				</div>
				<div class="panel-body">
					<?= $this->Form->create() ?>
						<fieldset>
							<?php
								echo $this->Form->input('username', ['class' => 'form-control', 'placeholder' => __('Your Username'), 'label' => false]);

								echo $this->Form->input('password', ['class' => 'form-control', 'placeholder' => __('Your Password'), 'label' => false]);

                 				echo $this->Form->input('auto_login', ['label' => 'Remember Me', 'type' => 'checkbox', 'templates' => [
                    			 'inputContainer' => '<div class="form-group"><div class="{{type}}{{required}}">{{content}}</div></div>']]);

							    echo $this->Form->submit(__('Login'), ['class' => 'btn btn-lg btn-success btn-block']); ?>

							<div class="bottom-links">
								<?php echo $this->Html->link(__('Password Reminder'), ['action' => 'reset']); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->element('Admin/footer'); ?>