<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movies Model
 *
 * @property \App\Model\Table\RatingsTable&\Cake\ORM\Association\BelongsTo $Ratings
 * @property \App\Model\Table\DirectorsTable&\Cake\ORM\Association\BelongsTo $Directors
 * @property \App\Model\Table\GenresTable&\Cake\ORM\Association\BelongsTo $Genres
 * @property \App\Model\Table\CastsTable&\Cake\ORM\Association\HasMany $Casts
 * @property \App\Model\Table\FavoritesTable&\Cake\ORM\Association\HasMany $Favorites
 *
 * @method \App\Model\Entity\Movie newEmptyEntity()
 * @method \App\Model\Entity\Movie newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Movie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Movie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Movie findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Movie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Movie[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Movie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MoviesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('movies');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ratings', [
            'foreignKey' => 'rating_id',
        ]);
        $this->belongsTo('Directors', [
            'foreignKey' => 'director_id',
        ]);
        $this->belongsTo('Genres', [
            'foreignKey' => 'genre_id',
        ]);
        $this->hasMany('Casts', [
            'foreignKey' => 'movie_id',
        ]);
        $this->hasMany('Favorites', [
            'foreignKey' => 'movie_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('duration')
            ->allowEmptyString('duration');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['rating_id'], 'Ratings'), ['errorField' => 'rating_id']);
        $rules->add($rules->existsIn(['director_id'], 'Directors'), ['errorField' => 'director_id']);
        $rules->add($rules->existsIn(['genre_id'], 'Genres'), ['errorField' => 'genre_id']);

        return $rules;
    }
}
