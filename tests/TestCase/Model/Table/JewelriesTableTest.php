<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JewelriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JewelriesTable Test Case
 */
class JewelriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JewelriesTable
     */
    public $Jewelries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.jewelries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Jewelries') ? [] : ['className' => 'App\Model\Table\JewelriesTable'];
        $this->Jewelries = TableRegistry::get('Jewelries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Jewelries);

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
}
