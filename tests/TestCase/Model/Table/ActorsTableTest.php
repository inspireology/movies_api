<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActorsTable Test Case
 */
class ActorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActorsTable
     */
    protected $Actors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Actors',
        'app.Casts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Actors') ? [] : ['className' => ActorsTable::class];
        $this->Actors = $this->getTableLocator()->get('Actors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Actors);

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
