<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Directors Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\HasMany $Movies
 *
 * @method \App\Model\Entity\Director newEmptyEntity()
 * @method \App\Model\Entity\Director newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Director[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Director get($primaryKey, $options = [])
 * @method \App\Model\Entity\Director findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Director patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Director[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Director|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Director saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Director[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Director[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Director[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Director[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DirectorsTable extends Table
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

        $this->setTable('directors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Movies', [
            'foreignKey' => 'director_id',
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
            ->scalar('name_first')
            ->maxLength('name_first', 64)
            ->allowEmptyString('name_first');

        $validator
            ->scalar('name_last')
            ->maxLength('name_last', 64)
            ->allowEmptyString('name_last');

        return $validator;
    }
}
