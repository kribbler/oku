<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Websites
 * @property \Cake\ORM\Association\BelongsTo $Materials
 * @property \Cake\ORM\Association\BelongsTo $ChangedMaterials
 * @property \Cake\ORM\Association\BelongsTo $MaterialColors
 * @property \Cake\ORM\Association\BelongsTo $ChangedMaterialColors
 * @property \Cake\ORM\Association\BelongsTo $Surfaces
 * @property \Cake\ORM\Association\BelongsTo $ChangedSurfaces
 * @property \Cake\ORM\Association\BelongsTo $DiamondColors
 * @property \Cake\ORM\Association\BelongsTo $ChangedDiamondColors
 * @property \Cake\ORM\Association\BelongsTo $DiamondClarities
 * @property \Cake\ORM\Association\BelongsTo $ChangedDiamondClarities
 * @property \Cake\ORM\Association\BelongsTo $Stones
 * @property \Cake\ORM\Association\BelongsTo $Actions
 * @property \Cake\ORM\Association\BelongsTo $MasterCategories
 * @property \Cake\ORM\Association\BelongsTo $Genders
 * @property \Cake\ORM\Association\BelongsTo $ChangedGenders
 * @property \Cake\ORM\Association\BelongsTo $Occasions
 * @property \Cake\ORM\Association\BelongsTo $ChangedOccasions
 * @property \Cake\ORM\Association\BelongsTo $Styles
 * @property \Cake\ORM\Association\BelongsTo $Chains
 * @property \Cake\ORM\Association\BelongsTo $Clasps
 * @property \Cake\ORM\Association\BelongsTo $MetalAndColors
 * @property \Cake\ORM\Association\HasMany $ItemFilterMetalAndColors
 * @property \Cake\ORM\Association\HasMany $ItemFilterStones
 * @property \Cake\ORM\Association\HasMany $ItemLengths
 * @property \Cake\ORM\Association\HasMany $ItemMetalAndColors
 * @property \Cake\ORM\Association\HasMany $ItemNecklaceTypes
 * @property \Cake\ORM\Association\HasMany $ItemOccasions
 * @property \Cake\ORM\Association\HasMany $ItemStones
 * @property \Cake\ORM\Association\HasMany $ItemTags
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null)
 */
class ItemsTable extends Table
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

        $this->table('items');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Websites', [
            'foreignKey' => 'website_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id'
        ]);
        $this->belongsTo('ChangedMaterials', [
            'foreignKey' => 'changed_material_id',
            'className' => 'Materials'
        ]);
        $this->belongsTo('MaterialColors', [
            'foreignKey' => 'material_color_id'
        ]);
        $this->belongsTo('ChangedMaterialColors', [
            'foreignKey' => 'changed_material_color_id',
            'className' => 'MaterialColors'
        ]);
        $this->belongsTo('Surfaces', [
            'foreignKey' => 'surface_id'
        ]);
        $this->belongsTo('ChangedSurfaces', [
            'foreignKey' => 'changed_surface_id',
            'className' => 'Surfaces'
        ]);
        $this->belongsTo('DiamondColors', [
            'foreignKey' => 'diamond_color_id'
        ]);
        $this->belongsTo('ChangedDiamondColors', [
            'foreignKey' => 'changed_diamond_color_id',
            'className' => 'DiamondColors'
        ]);
        $this->belongsTo('DiamondClarities', [
            'foreignKey' => 'diamond_clarity_id'
        ]);
        $this->belongsTo('ChangedDiamondClarities', [
            'foreignKey' => 'changed_diamond_clarity_id',
            'className' => 'DiamondClarities'
        ]);
        $this->belongsTo('Stones', [
            'foreignKey' => 'stone_id'
        ]);
        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id'
        ]);
        $this->belongsTo('MasterCategories', [
            'foreignKey' => 'master_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id'
        ]);
        $this->belongsTo('ChangedGenders', [
            'foreignKey' => 'changed_gender_id',
            'className' => 'Genders'
        ]);
        $this->belongsTo('Occasions', [
            'foreignKey' => 'occasion_id'
        ]);
        $this->belongsTo('ChangedOccasions', [
            'foreignKey' => 'changed_occasion_id',
            'className' => 'Occasions'
        ]);
        $this->belongsTo('Styles', [
            'foreignKey' => 'style_id'
        ]);
        $this->belongsTo('Chains', [
            'foreignKey' => 'chain_id'
        ]);
        $this->belongsTo('Clasps', [
            'foreignKey' => 'clasp_id'
        ]);
        $this->belongsTo('MetalAndColors', [
            'foreignKey' => 'metal_and_color_id'
        ]);
        $this->hasMany('ItemFilterMetalAndColors', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemFilterStones', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemLengths', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemMetalAndColors', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemNecklaceTypes', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemOccasions', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemStones', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('ItemTags', [
            'foreignKey' => 'item_id'
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

        $validator
            ->allowEmpty('changed_name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->allowEmpty('changed_description');

        $validator
            ->integer('metalstamp')
            ->allowEmpty('metalstamp');

        $validator
            ->integer('changed_metalstamp')
            ->allowEmpty('changed_metalstamp');

        $validator
            ->allowEmpty('other_stones');

        $validator
            ->allowEmpty('diamond_abrasive');

        $validator
            ->allowEmpty('changed_diamond_abrasive');

        $validator
            ->allowEmpty('diamond_weight');

        $validator
            ->allowEmpty('changed_diamond_weight');

        $validator
            ->integer('diamond_number')
            ->allowEmpty('diamond_number');

        $validator
            ->integer('changed_diamond_number')
            ->allowEmpty('changed_diamond_number');

        $validator
            ->allowEmpty('diamond_cut');

        $validator
            ->allowEmpty('changed_diamond_cut');

        $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->allowEmpty('brand');

        $validator
            ->allowEmpty('changed_brand');

        $validator
            ->allowEmpty('image_small');

        $validator
            ->boolean('image_processed')
            ->allowEmpty('image_processed');

        $validator
            ->boolean('tags_processed')
            ->allowEmpty('tags_processed');

        $validator
            ->allowEmpty('designer');

        $validator
            ->allowEmpty('changed_designer');

        $validator
            ->allowEmpty('comments');

        $validator
            ->allowEmpty('height');

        $validator
            ->boolean('has_length')
            ->allowEmpty('has_length');

        $validator
            ->boolean('manual')
            ->allowEmpty('manual');

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
        $rules->add($rules->existsIn(['website_id'], 'Websites'));
        $rules->add($rules->existsIn(['material_id'], 'Materials'));
        $rules->add($rules->existsIn(['changed_material_id'], 'ChangedMaterials'));
        $rules->add($rules->existsIn(['material_color_id'], 'MaterialColors'));
        $rules->add($rules->existsIn(['changed_material_color_id'], 'ChangedMaterialColors'));
        $rules->add($rules->existsIn(['surface_id'], 'Surfaces'));
        $rules->add($rules->existsIn(['changed_surface_id'], 'ChangedSurfaces'));
        $rules->add($rules->existsIn(['diamond_color_id'], 'DiamondColors'));
        $rules->add($rules->existsIn(['changed_diamond_color_id'], 'ChangedDiamondColors'));
        $rules->add($rules->existsIn(['diamond_clarity_id'], 'DiamondClarities'));
        $rules->add($rules->existsIn(['changed_diamond_clarity_id'], 'ChangedDiamondClarities'));
        $rules->add($rules->existsIn(['stone_id'], 'Stones'));
        $rules->add($rules->existsIn(['action_id'], 'Actions'));
        $rules->add($rules->existsIn(['master_category_id'], 'MasterCategories'));
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        $rules->add($rules->existsIn(['changed_gender_id'], 'ChangedGenders'));
        $rules->add($rules->existsIn(['occasion_id'], 'Occasions'));
        $rules->add($rules->existsIn(['changed_occasion_id'], 'ChangedOccasions'));
        $rules->add($rules->existsIn(['style_id'], 'Styles'));
        $rules->add($rules->existsIn(['chain_id'], 'Chains'));
        $rules->add($rules->existsIn(['clasp_id'], 'Clasps'));
        $rules->add($rules->existsIn(['metal_and_color_id'], 'MetalAndColors'));

        return $rules;
    }
}
