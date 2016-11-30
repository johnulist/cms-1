<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Page</h1>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= __('Page Details');?>
    </div>
    <div class="panel-body">
        <?= $this->Form->create($page) ?>
            <fieldset>
                <?php
                    echo $this->Form->input('meta_title', array('label' => 'Page Title (This is what is shown on the website navigation.)', 'div' => 'form-group', 'class' => 'form-control'));

                    echo $this->Form->input('meta_description', array('label' => 'Page Description (Keep this to about 150 characters, its important for Search Engines.)', 'div' => 'form-group', 'class' => 'form-control'));

                    echo $this->Form->input('meta_keywords', array('label' => 'Page Keywords / Phrases (Keep these in lower case, separated by comma\'s.)', 'div' => 'form-group', 'class' => 'form-control'));

                    echo $this->Ck->input('content', ['label' => 'Content'], ['extraAllowedContent' => '*(*)']);

                    echo $this->Form->submit(__('Save Changes'), ['div' => false, 'class' => 'btn btn-primary']);
                ?>
            </fieldset>
        <?= $this->Form->end();?>
    </div>
    <div class="panel-footer">
        <?= $this->Html->link(__('Back to Pages'), ['action' => 'index'], ['class' => 'btn btn-default']);?>
    </div>
</div>