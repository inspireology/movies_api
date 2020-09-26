<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CastsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CastsTable Test Case
 */
class CastsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CastsTable
     */
    protected $Casts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Casts',
        'app.Actors',
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
        $config = $this->getTableLocator()->exists('Casts') ? [] : ['className' => CastsTable::class];
        $this->Casts = $this->getTableLocator()->get('Casts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Casts);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
