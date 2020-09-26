<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Movie Entity
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $duration
 * @property int|null $rating_id
 * @property int|null $director_id
 * @property int|null $genre_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Rating $rating
 * @property \App\Model\Entity\Director $director
 * @property \App\Model\Entity\Genre $genre
 * @property \App\Model\Entity\Cast[] $casts
 * @property \App\Model\Entity\Favorite[] $favorites
 */
class Movie extends Entity
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
        'title' => true,
        'description' => true,
        'duration' => true,
        'rating_id' => true,
        'director_id' => true,
        'genre_id' => true,
        'created' => true,
        'modified' => true,
        'rating' => true,
        'director' => true,
        'genre' => true,
        'casts' => true,
        'favorites' => true,
    ];
}
