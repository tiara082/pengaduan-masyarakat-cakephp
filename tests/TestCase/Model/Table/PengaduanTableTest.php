<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PengaduanTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PengaduanTable Test Case
 */
class PengaduanTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PengaduanTable
     */
    protected $Pengaduan;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Pengaduan',
        'app.Petugas',
        'app.Tanggapan',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pengaduan') ? [] : ['className' => PengaduanTable::class];
        $this->Pengaduan = $this->getTableLocator()->get('Pengaduan', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pengaduan);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PengaduanTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PengaduanTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
