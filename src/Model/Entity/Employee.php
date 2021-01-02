<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $employee_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property string|resource|null $image
 */
class Employee extends Entity
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
        'name' => true,
        'address' => true,
        'email' => true,
        'phone' => true,
        'dob' => true,
        'image' => true,
    ];
}
