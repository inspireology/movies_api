<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiTable Test Case
 */
class ApiTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiTable
     */
    protected $Api;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Api',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Api') ? [] : ['className' => ApiTable::class];
        $this->Api = $this->getTableLocator()->get('Api', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Api);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
