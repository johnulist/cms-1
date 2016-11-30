<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Manage Users') ?></h1>
    </div>
</div>

<div class="well">
    <?=  $this->Form->create();?>
        <fieldset class="form-group">
            <div class="input-group custom-search-form">
                <?php if (!empty($search)) : ?>
                    <?=  $this->Form->input('search', array('class' => 'form-control', 'label' => false, 'div' => false, 'value' => $search));?>
                <?php else : ?>
                    <?=  $this->Form->input('search',
                                                  array('type' => 'text',
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Search...',
                                                        'label' => false,
                                                        'div' => false));?>
                <?php endif; ?>

                <span class="input-group-btn">
                        <?=  $this->Form->button('<i class="fa fa-search"></i>',
                                                       array('class' => 'btn btn-default',
                                                             'escape' => false,
                                                             'type' => 'submit',
                                                             'div' => false));?>
                    </span>
            </div>
            <!-- /input-group -->
        </fieldset>
        <?php if (!empty($search)) : ?>
            <?=  $this->Html->link(__('Reset'), array('action' => 'index')); ?>
        <?php endif; ?>
    <?=  $this->Form->end();?>

    <?=  $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add a User'),
                                 array('action' => 'add'),
                                 array('class' => 'btn btn-primary',
                                       'escape' => false)); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= __('Users') ?>
    </div>
    <div class="panel-body">
        <?php if ($users->count()) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('username') ?></th>
                            <th><?= $this->Paginator->sort('first_name') ?></th>
                            <th><?= $this->Paginator->sort('last_name') ?></th>
                            <th><?= $this->Paginator->sort('email') ?></th>
                            <th><?= __('Options') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= h($user->username); ?></td>
                                <td><?= h($user->first_name); ?></td>
                                <td><?= h($user->last_name); ?></td>
                                <td><?= $this->Text->autoLinkEmails($user->email); ?></td>
                                <td class="actions">
                                    <?php
                                        echo $this->Html->link('<i class="fa fa-edit"></i>',
                                                           ['action' => 'edit', $user->id],
                                                           ['class' => 'btn btn-warning',
                                                                 'escape' => false,
                                                                 'alt' => __('Edit'),
                                                                 'title' => __('Edit')]);

                                        echo '&nbsp;';
                                        echo $this->Form->postLink('<i class="fa fa-trash-o"></i>',
                                                               array('action' => 'delete', $user->id),
                                                               array('class' => 'btn btn-danger',
                                                                     'escape' => false,
                                                                     'alt' => __('Delete'),
                                                                     'title' => __('Delete'),
                                                                     'confirm' => __('Are you sure you want to delete the user: {0}?', $user->name)));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?= $this->element('Admin/pagination') ?>
            </div>
        <?php elseif (!empty($search)) : ?>
            <p><?= __('Your search returned no results, please try again!') ?></p>
        <?php else : ?>
            <?= __('There are no users at the moment!') ?>
        <?php endif; ?>
    </div>
</div>