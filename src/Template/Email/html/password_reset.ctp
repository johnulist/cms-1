<p>Hi There</p>

<p>You have requested to reset your password. Please click on the following link to reset your password now:</p>

<?= $this->Html->link(__('Click here to reset your password'), $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword', $token], true)); ?>