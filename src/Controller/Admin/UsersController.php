<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Mailer\Email;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['reset', 'resetPassword', 'install']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = ['limit' => 50, 'order' => ['first_name' => 'asc', 'last_name' => 'asc']];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    public function home()
    {
        $this->loadModel('Settings');
        $siteName         = $this->Settings->getSetting('siteName');
        $siteEmail        = $this->Settings->getSetting('siteEmail');

        $this->set(compact('siteName', 'siteEmail'));
    }

    /**
     * Login method
     *
     * @return \Cake\Network\Response|null
     */
    public function login() {
        if ($this->Auth->user('id')) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if (!$this->Users->hasUsers()) {
            return $this->redirect(['action' => 'install']);
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                if (!empty($this->request->data['auto_login'])) {
                    $this->Cookie->configKey('userId', ['expires' => '+180 days']);
                    $this->Cookie->write('userId', $user['id']);
                }

                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Your Username or password is incorrect'));
            }
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Network\Response|null
     */
    public function logout()
    {
        $this->Cookie->delete('userId');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($admin, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been successfully created.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));

        return $this->render('form');
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($admin)) {
                $this->Flash->success(__('The user has been updated.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));

        return $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Reset method
     *
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
    */
    public function reset()
    {
        if ($this->request->is('post')) {
            $admin = $this->Admins->findByEmail($this->request->data['email'])->first();
            if (!$admin) {
                $this->Flash->error(__('That email is not valid.'));
            } else {
                $token = $this->Admins->generateToken($admin->username . $admin->first_name . $admin->last_name);
                $admin->token = $token;
                if ($this->Admins->save($admin)) {
                    $this->Flash->success(__('An email containing the reset link has been sent.'));
                    $this->Email->sendResetEmail($this->request->data['email'], $token);

                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('Something went wrong, please try again later.'));
                }
            }
        }
    }

    /**
     * Reset Password method
     *
     * @param string|null $token Admin token.
     * @return \Cake\Network\Response|void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function resetPassword($token = null)
    {
        if (!$token) {
            throw new NotFoundException("Error Processing Request");
        }
        $admin = $this->Admins->find('all')->where(['Admins.token' => $token])->first();
        if (!$admin) {
            throw new NotFoundException('Error Processing Request');
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin->token = null;
            $admin = $this->Admins->patchEntity($admin, $this->request->data);

            // not sure why _setPassword isn't called before save
            $admin->password = $this->Admins->setPassword($admin->password);

            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('Password updated'));
                $this->Auth->setUser($admin);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('There was a problem, please review the errors and try again.');
            }
        }

        $this->set(compact('admin'));
    }

    /**
     * Installs the application
     *
     * @return \Cake\Network\Response|void.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function install() {
        if ($this->Auth->user('id')) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->User->hasUsers()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            try {
                $this->Users->install($this->request->data);
                $user = $this->Auth->identify();

                if ($user) {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('Coderity has been successfully installed and you have been automatically logged in!'));
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error(__('Your Username or password is incorrect'), ['key' => 'auth']);
                }
            } catch (Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        }
    }
}