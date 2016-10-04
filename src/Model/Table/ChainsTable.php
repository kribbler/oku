<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chains Model
 *
 * @property \Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\Chain get($primaryKey, $options = [])
 * @method \App\Model\Entity\Chain newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Chain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Chain|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Chain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Chain[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Chain findOrCreate($search, callable $callback = null)
 */
class ChainsTable extends Table
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

        $this->table('chains');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'chain_id'
        ]);
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

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
