<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TanggapanTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TanggapanTable Test Case
 */
class TanggapanTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TanggapanTable
     */
    protected $Tanggapan;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Tanggapan',
        'app.Petugas',
        'app.Pengaduan',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tanggapan') ? [] : ['className' => TanggapanTable::class];
        $this->Tanggapan = $this->getTableLocator()->get('Tanggapan', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tanggapan);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TanggapanTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TanggapanTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
