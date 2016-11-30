<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $this->request->action == 'add' ? __('Add a User') : __('Update a User') ?></h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= __('User Details') ?>
    </div>
    <div class="panel-body">
        <?php
            echo $this->Form->create($user);
            echo $this->Form->input('admin', ['type' => 'hidden', 'value' => true]);
        ?>
            <fieldset>
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('first_name', ['class' => 'form-control']);
                            echo $this->Form->input('last_name', ['class' => 'form-control']);
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                            echo $this->Form->input('username', ['class' => 'form-control']);
                            echo $this->Form->input('email', ['class' => 'form-control']);
                        ?>
                    </div>
                </div>

                <?php if ($this->request->action == 'add') : ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->Form->input('password', ['class' => 'form-control']) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <?= $this->Form->submit(__('Save Changes'), ['class' => 'btn btn-primary']) ?>
                </div>
            </fieldset>
        <?= $this->Form->end() ?>
    </div>

    <div class="panel-footer">
        <?= $this->Html->link(__('Back to users'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
</div>