<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;

class UserMailer extends Mailer
{
    public function resetPassword($user)
    {
        $this->setFromName();

        $this
            ->to($user->email)
            ->subject('Reset Password Request')
            ->emailFormat('html')
            ->template('passwordReset')
            ->set(['token' => $user->token]);
    }

    protected function setFromName()
    {
        $Settings = TableRegistry::get('Settings');

        $this->fromEmail = $Settings->getSetting('siteEmail');
        $this->fromName  = $Settings->getSetting('siteName');

        $this->from([$this->fromEmail => $this->fromName]);
    }
}