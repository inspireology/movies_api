<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FavoritesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FavoritesTable Test Case
 */
class FavoritesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FavoritesTable
     */
    protected $Favorites;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Favorites',
        'app.Users',
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
        $config = $this->getTableLocator()->exists('Favorites') ? [] : ['className' => FavoritesTable::class];
        $this->Favorites = $this->getTableLocator()->get('Favorites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Favorites);

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
