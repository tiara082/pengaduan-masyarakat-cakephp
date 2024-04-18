<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TanggapanFixture
 */
class TanggapanFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'tanggapan';
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
                'tg_tanggapan' => '2024-04-04 00:56:58',
                'isi_laporan' => 'Lorem ipsum dolor sit amet',
                'petugas_id' => 1,
                'pengaduan_id' => 1,
            ],
        ];
        parent::init();
    }
}
