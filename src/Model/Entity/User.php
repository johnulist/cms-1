<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $email
 * @property string $web_address
 * @property string $password
 * @property string $company
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $delivery_address
 * @property string $delivery_postcode
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $billing
 * @property string $billing_name
 * @property string $billing_email
 * @property string $business
 * @property string $principal
 * @property string $employees
 * @property string $trade_1
 * @property string $trade_2
 * @property string $trade_3
 * @property string $trade_4
 * @property string $trade_5
 * @property string $site_safe
 * @property string $project_1
 * @property string $project_2
 * @property string $project_3
 * @property string $project_4
 * @property string $project_5
 * @property string $project_1_value
 * @property string $project_2_value
 * @property string $project_3_value
 * @property string $project_4_value
 * @property string $project_5_value
 * @property string $project_1_client
 * @property string $project_2_client
 * @property string $project_3_client
 * @property string $project_4_client
 * @property string $project_5_client
 * @property string $project_1_referee
 * @property string $project_2_referee
 * @property string $project_3_referee
 * @property string $project_4_referee
 * @property string $project_5_referee
 * @property string $project_1_date
 * @property string $project_2_date
 * @property string $project_3_date
 * @property string $project_4_date
 * @property string $project_5_date
 * @property string $other_trade
 * @property int $status_id
 * @property \Cake\I18n\Time $temp_access_expire
 * @property \Cake\I18n\Time $last_click
 * @property \Cake\I18n\Time $last_reset
 * @property \Cake\I18n\Time $last_login
 * @property \Cake\I18n\Time $last_check
 * @property string $special_requirements
 * @property bool $lots_on_only
 * @property string $alpha_code
 * @property int $exo_id
 * @property bool $master
 * @property bool $ignore_exo
 * @property bool $ignore_reports
 * @property bool $admin
 * @property string $token
 * @property bool $out_auckland
 * @property bool $in_auckland
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\ParentUser $parent_user
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Exo $exo
 * @property \App\Model\Entity\WEBACC[] $w_e_b_a_c_c
 * @property \App\Model\Entity\Account[] $accounts
 * @property \App\Model\Entity\Activity[] $activities
 * @property \App\Model\Entity\BackupOrder[] $backup_orders
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\JobView[] $job_views
 * @property \App\Model\Entity\New[] $new
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Release[] $releases
 * @property \App\Model\Entity\Survey[] $surveys
 * @property \App\Model\Entity\TicketComment[] $ticket_comments
 * @property \App\Model\Entity\Ticket[] $tickets
 * @property \App\Model\Entity\TradebundleRequest[] $tradebundle_requests
 * @property \App\Model\Entity\UserDetail[] $user_details
 * @property \App\Model\Entity\UserNote[] $user_notes
 * @property \App\Model\Entity\ChildUser[] $child_users
 * @property \App\Model\Entity\Watchlist[] $watchlists
 * @property \App\Model\Entity\Subcategory[] $subcategories
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];

    protected function _getName()
    {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
}