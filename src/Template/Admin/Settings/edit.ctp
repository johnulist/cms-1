<?php
    use Cake\Utility\Inflector;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Edit Setting') ?></h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo Inflector::Humanize($setting->name);?>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($setting) ?>
            <fieldset>
                <div class="form-group">
                    <?= $this->Form->input('value', ['class' => 'form-control']) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->submit(__('Save Changes'), ['class' => 'btn btn-primary']) ?>
                </div>
            </fieldset>
        <?php echo $this->Form->end();?>
    </div>
    <div class="panel-footer">
        <?php echo $this->Html->link(__('Back to Settings'),
                                     ['action' => 'index'],
                                     ['class' => 'btn btn-default']) ?>
    </div>
</div>