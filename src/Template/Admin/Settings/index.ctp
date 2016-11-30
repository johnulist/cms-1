<?php
    use Cake\Utility\Inflector;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Site Settings') ?></h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= __('Settings') ?>
    </div>
    <div class="panel-body">
        <?php if ($settings->count()) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th><?=  $this->Paginator->sort('name') ?></th>
                            <th><?=  $this->Paginator->sort('modified', __('Last Modified')) ?></th>
                            <th><?=  __('Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($settings as $setting): ?>
                            <tr>
                                <td><?=  Inflector::Humanize($setting->name); ?></td>
                                <td><?=  $this->Time->nice($setting->modified); ?></td>
                                <td class="actions">
                                    <?php
                                    echo $this->Html->link('<i class="fa fa-edit"></i>',
                                                           ['action' => 'edit', $setting->id],
                                                           ['class' => 'btn btn-warning',
                                                                 'escape' => false,
                                                                 'alt' => __('Edit'),
                                                                 'title' => __('Edit')]);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?= $this->element('Admin/pagination') ?>
            </div>
        <?php else: ?>
            <?= __('There are no settings at the moment.') ?>
        <?php endif; ?>
    </div>
</div>