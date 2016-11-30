<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?= __('Coderity CMS Dashboard') ?></h1>
	</div>
</div>

<?php if (!$siteName) : ?>
	<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <?= __('A Site Name is required for the website to work correctly.') ?></div>
<?php endif; ?>

<?php if (!$siteEmail) : ?>
	<div class="alert alert-danger"><i class="fa fa-info-circle"></i> <?= __('A Site Email is required for the website to work correctly.') ?></div>
<?php endif; ?>

<?php if (!$siteName || !$siteEmail) : ?>
	<p><?= $this->Html->link(__('Visit the Settings page now to resolve these issues'), ['controller' => 'Settings', 'action' => 'index']); ?></p>
<?php endif; ?>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?= __('What Would you like to do?') ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?= $this->Html->link(__('Manage Site Pages'), ['controller' => 'Pages', 'action' => 'index']) ?>
			</div>
			<div class="panel-body">
				<p><?= __('Manage your website pages and set the website menu.') ?></p>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				<?= $this->Html->link(__('Manage Setings'), ['controller' => 'Settings', 'action' => 'index']); ?>
			</div>
			<div class="panel-body">
				<p><?= __('Add, edit and delete various website settings.') ?></p>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<?= $this->Html->link(__('User Management'), ['controller' => 'Users', 'action' => 'index']); ?>
			</div>
			<div class="panel-body">
				<p><?= __('Control which users have access to the CMS.') ?></p>
			</div>
		</div>
	</div>
</div>