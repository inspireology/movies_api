<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Api Model
 *
 * @method \App\Model\Entity\Api newEmptyEntity()
 * @method \App\Model\Entity\Api newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Api[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Api get($primaryKey, $options = [])
 * @method \App\Model\Entity\Api findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Api patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Api[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Api|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Api saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApiTable extends Table
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

        $this->setTable('api');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 128)
            ->allowEmptyString('name');

        $validator
            ->scalar('api_key')
            ->allowEmptyString('api_key');

        $validator
            ->boolean('is_enabled')
            ->allowEmptyString('is_enabled');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        return $validator;
    }

    public function isValidApiKey(String $apiKey)
    {
        $keyResult = $this
            ->find()
            ->select(['id'])
            ->where(['api_key =' => $apiKey])
            ->andWhere(['is_enabled' => 1])
            ->count();

        return $keyResult ? true : false;
    }
}
