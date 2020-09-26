<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Genres Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\HasMany $Movies
 *
 * @method \App\Model\Entity\Genre newEmptyEntity()
 * @method \App\Model\Entity\Genre newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Genre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Genre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Genre findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Genre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Genre[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Genre|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Genre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Genre[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Genre[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Genre[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Genre[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GenresTable extends Table
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

        $this->setTable('genres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Movies', [
            'foreignKey' => 'genre_id',
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
            ->scalar('name_display')
            ->maxLength('name_display', 64)
            ->allowEmptyString('name_display');

        return $validator;
    }
}
