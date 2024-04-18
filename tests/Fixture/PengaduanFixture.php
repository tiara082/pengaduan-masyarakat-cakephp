<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PengaduanFixture
 */
class PengaduanFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'pengaduan';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'tg_pengaduan' => '2024-04-04 02:50:57',
                'isi_laporan' => 'Lorem ipsum dolor sit amet',
                'foto' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'petugas_id' => 1,
            ],
        ];
        parent::init();
    }
}
