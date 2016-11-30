<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= __('Manage Pages'); ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= __('Current Pages'); ?>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if ($pages->count()) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('meta_title', 'title') ?></th>
                                    <th><?= __('Options') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pages as $page): ?>
                                    <tr>
                                        <td><?= h($page->name) ?></td>
                                        <td><?= h($page->meta_title) ?></td>
                                        <td class="actions">
                                            <?php
                                                echo $this->Html->link('<i class="fa fa-edit"></i>',
                                                                       ['action' => 'edit', $page->id],
                                                                       ['class' => 'btn btn-warning',
                                                                        'escape' => false,
                                                                        'alt' => __('Edit'),
                                                                        'title' => __('Edit')]);
                                                echo '&nbsp;';
                                                echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $page->id], ['class' => 'btn btn-danger',
                                                                        'escape' => false,
                                                                        'alt' => __('Delete'),
                                                                        'title' => __('Delete'),
                                                                        'confirm' => __('Are you sure you want to delete this page?')]);
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?= $this->element('Admin/pagination'); ?>
                    </div>
                <?php else : ?>
                    <?= __('There are no pages at the moment!'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>