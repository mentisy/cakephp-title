<?php
declare(strict_types=1);

namespace TestApp\Model\Entity;

use Cake\ORM\Entity;

/**
 * Monitoring Entity
 *
 * @property int $id
 * @property bool $onLoan
 * @property bool $onReturn
 * @property string $comment
 */
class Monitoring extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'onLoan' => true,
        'onReturn' => true,
        'comment' => true,
    ];
}
