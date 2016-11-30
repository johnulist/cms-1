<?php
namespace App\Controller\Component;

use Cake\Mailer\Email;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class EmailComponent extends Component
{
    public $fromEmail = 'orders@btsl.co.nz';
    public $fromName  = 'BTSL';

	/**
     * Send Reset Email method
     *
     * @param string|null $emailAddress Admin email address, $token Admin reset token.
     * @return \Cake\Network\Response|void.
     * @throws \Cake\Network\Exception\NotFoundException.
     */
	public function sendResetEmail($emailAddress = null, $token = null)
    {
        if ($token == null || $emailAddress == null) {
            throw new NotFoundException("Error Processing Request");
        }
        $email = new Email('default');
        $email->viewVars(['token' => $token]);
        $email->helpers(['Html']);
        $email->template('admin_password_reset', 'default')
            ->emailFormat('html')
            ->from([$this->fromEmail => $this->fromName])
            ->to($emailAddress)
            ->subject(__('Reset Password'))
            ->send();
        return;
    }

    /**
     * Notify the subcontractors when there are changes to the documents
     * @param  array $data
     * @param  int   $jobId
     * @param  bool  $revisions
     * @return bool
     */
    public function notifySubcontractorsDocumentsChanged($data, $jobId, $revisions = false) {
        $job = TableRegistry::get('Jobs')->get($jobId);

        $this->Documents = TableRegistry::get('Documents');

        $options = [];
        $options['conditions'] = ['job_id' => $jobId, 'notes !=' => 'Release of Job', 'stop_emails' => false];
        $options['contain']    = 'Users';
        $options['group']      = 'user_id';
        $options['fields']     = ['Users.email', 'Users.name'];

        $users = $this->Documents->Jobs->Orders->find('all', $options)->toArray();

        if (!$users) {
            return false;
        }

        $documents = [];

        foreach ($data as $id => $checked) {
            if (!$checked) {
                continue;
            }

            $document = $this->Documents->get($id, ['contain' => 'Types']);

            if (substr($checked, 0, 8) == 'replace|') {
                $replaceId = substr($checked, 8);
                $document->Replace = $this->Documents->get($replaceId);
            }

            $documents[$document->type->name][$this->Documents->setFolderName($document->folder, $document->subfolder)][] = $document;
        }

        if (!$documents) {
            return false;
        }

        foreach ($users as $user) {
            $emailAddress = $user->Users->email;

            $Email = new Email('default');
            $Email->viewVars(compact('job', 'documents', 'user', 'revisions'));
            $Email->helpers(['Html']);
            $Email->template('Admin/subcontractor_documents_changed', 'default')
                ->emailFormat('html')
                ->from([$this->fromEmail => $this->fromName])
                ->to($emailAddress)
                ->subject(__('{0} - Changes to Documents', $job->title))
                ->send();
        }

        return true;
    }

    /**
     * Sends the work desk login for a ContractorContact
     * @param  array $data
     * @param  string $password
     * @return bool
     */
    public function workDeskLogin($data, $password = null) {
        $Email = new Email('default');
        $Email->viewVars(['user' => $data, 'password' => $password]);
        $Email->helpers(['Html']);
        $Email->template('Admin/workdesk', 'default')
            ->emailFormat('html')
            ->from([$this->fromEmail => $this->fromName])
            ->to($data['email'])
            ->subject(__('BTSL - Work Desk Login Information'))
            ->send();

        return true;
    }
}