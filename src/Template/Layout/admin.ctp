<?= $this->element('Admin/header'); ?>

<div id="wrapper">
    <?= $this->element('Admin/menu'); ?>

    <div id="page-wrapper">
        <?php
            echo $this->Flash->render();
            echo $this->fetch('content');
        ?>
    </div>
</div>

<?php echo $this->element('Admin/footer'); ?>