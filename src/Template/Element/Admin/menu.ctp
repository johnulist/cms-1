<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?= __('Toggle navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li>
        <?= $this->Html->link('<i class="fa fa-file-picture-o fa-fw"></i> ' . __('View Site'), '/', array('target' => '_blank', 'escape' => false)); ?>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <?= $this->Html->link('<i class="fa fa-user fa-fw"></i> ' . __('Change Password'), array('plugin' => false, 'controller' => 'Users', 'action' => 'password'), array('escape' => false)); ?>
                </li>
                <li class="divider"></li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-sign-out fa-fw"></i> ' . __('Logout'), array('plugin' => false, 'controller' => 'Users', 'action' => 'logout'), array('escape' => false)); ?>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                <?= $this->Html->image('logo.png', ['url' => ['plugin' => false, 'controller' => 'Users', 'action' => 'home']], ['class' => 'navbar-brand']); ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-dashboard fa-fw"></i> ' . __('Home'), ['plugin' => false, 'controller' => 'Users', 'action' => 'home'], ['escape' => false]); ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-sitemap fa-fw"></i> ' . __('Pages'), ['plugin' => false, 'controller' => 'Pages', 'action' => 'index'], ['escape' => false]); ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-users fa-fw"></i> ' . __('Users'), ['plugin' => false, 'controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="fa fa-table fa-fw"></i> ' . __('Settings'), ['plugin' => false, 'controller' => 'Settings', 'action' => 'index'], ['escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>