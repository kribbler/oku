<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ItemsController Test Case
 */
class ItemsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
