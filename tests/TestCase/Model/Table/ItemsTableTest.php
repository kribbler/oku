<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemsTable Test Case
 */
class ItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemsTable
     */
    public $Items;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.items',
        'app.websites',
        'app.materials',
        'app.changed_materials',
        'app.material_colors',
        'app.changed_material_colors',
        'app.surfaces',
        'app.changed_surfaces',
        'app.diamond_colors',
        'app.changed_diamond_colors',
        'app.diamond_clarities',
        'app.changed_diamond_clarities',
        'app.stones',
        'app.actions',
        'app.master_categories',
        'app.genders',
        'app.changed_genders',
        'app.occasions',
        'app.changed_occasions',
        'app.styles',
        'app.chains',
        'app.clasps',
        'app.metal_and_colors',
        'app.item_filter_metal_and_colors',
        'app.item_filter_stones',
        'app.item_lengths',
        'app.item_metal_and_colors',
        'app.item_necklace_types',
        'app.item_occasions',
        'app.item_stones',
        'app.item_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Items') ? [] : ['className' => 'App\Model\Table\ItemsTable'];
        $this->Items = TableRegistry::get('Items', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Items);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
