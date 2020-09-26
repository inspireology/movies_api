<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DirectorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DirectorsTable Test Case
 */
class DirectorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DirectorsTable
     */
    protected $Directors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Directors',
        'app.Movies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Directors') ? [] : ['className' => DirectorsTable::class];
        $this->Directors = $this->getTableLocator()->get('Directors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Directors);

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
