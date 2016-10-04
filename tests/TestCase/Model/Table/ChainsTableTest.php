<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChainsTable Test Case
 */
class ChainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChainsTable
     */
    public $Chains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chains',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Chains') ? [] : ['className' => 'App\Model\Table\ChainsTable'];
        $this->Chains = TableRegistry::get('Chains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Chains);

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
