<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Exception\NotFoundException;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentUsers
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 * @property \Cake\ORM\Association\HasMany $WEBACC
 * @property \Cake\ORM\Association\HasMany $Accounts
 * @property \Cake\ORM\Association\HasMany $Activities
 * @property \Cake\ORM\Association\HasMany $Items
 * @property \Cake\ORM\Association\HasMany $JobViews
 * @property \Cake\ORM\Association\HasMany $New
 * @property \Cake\ORM\Association\HasMany $Orders
 * @property \Cake\ORM\Association\HasMany $Releases
 * @property \Cake\ORM\Association\HasMany $Surveys
 * @property \Cake\ORM\Association\HasMany $TicketComments
 * @property \Cake\ORM\Association\HasMany $Tickets
 * @property \Cake\ORM\Association\HasMany $TradebundleRequests
 * @property \Cake\ORM\Association\HasMany $UserDetails
 * @property \Cake\ORM\Association\HasMany $UserNotes
 * @property \Cake\ORM\Association\HasMany $ChildUsers
 * @property \Cake\ORM\Association\HasMany $Watchlists
 * @property \Cake\ORM\Association\BelongsToMany $Subcategories
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator->notEmpty('username', 'A username is required.');
        $validator->notEmpty('first_name', 'First name is required.');
        $validator->notEmpty('last_name', 'Last name is required.');

        $validator->add(
            'username',
            ['unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'That username is already taken.']
            ]
        );

        $validator
            ->notEmpty('email', 'Email Address is required')
            ->email('email', 'The email address you entered is invalid');

        $validator->add(
            'email',
            ['unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Someone else has already registered with that email address.']
            ]
        );

        $validator->notEmpty('password', 'Please enter in your new password.');

        $validator->add('password', [
            'minLength' => [
                'rule' => ['minLength', 6],
                'message' => 'Please ensure the password is at least 6 characters long.'
            ]
        ]);

        $validator->add('password', [
            'compare' => [
                'rule' => ['compareWith', 'confirm_password'],
                'message' => 'Please ensure the passwords match.'
            ]
        ]);

        $validator->notEmpty('confirm_password', 'Please confirm your new password.');

        $validator->notEmpty('current_password', 'Please confirm your current password.');

        $validator->add('current_password', 'custom', [
            'rule' => 'checkPassword',
            'provider' => 'table',
            'message' => 'The password you entered is incorrect.'
        ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    /**
     * Checks if users exist
     * @return bool
     */
    public function hasUsers() {
        $users = $this->find('all');

        if ($users->count() == 0) {
            return false;
        }

        return true;
    }

    /**
     * Generates a random token
     *
     * @param int $length How long the new token will be
     * @return string
     */
    public function generateToken($length = 8) {
        $randomString = 'abcdefghjkmnpqrstuvwqyz23456789';

        $token = null;

        for ($i = 0; $i < $length; $i++) {
            $token .= substr($randomString, mt_rand(0, strlen($randomString) - 1), 1);
        }

        return $token;
    }

    /**
     * Checks a password matches
     * @param  string $value
     * @param  array  $data
     * @return boolean
     */
    public function checkPassword($value, $data = [])
    {
        if (empty($data['data']['id']) || empty($value)) {
            return true;
        }

        $user = $this->get($data['data']['id'], ['fields' => 'password']);

        return (new DefaultPasswordHasher)->check($value, $user->password);
    }
}