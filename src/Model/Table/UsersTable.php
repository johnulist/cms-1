<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Exception\NotFoundException;

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
}