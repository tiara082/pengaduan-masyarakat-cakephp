<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tanggapan Model
 *
 * @property \App\Model\Table\PetugasTable&\Cake\ORM\Association\BelongsTo $Petugas
 * @property \App\Model\Table\PengaduanTable&\Cake\ORM\Association\BelongsTo $Pengaduan
 *
 * @method \App\Model\Entity\Tanggapan newEmptyEntity()
 * @method \App\Model\Entity\Tanggapan newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tanggapan> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tanggapan get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tanggapan findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tanggapan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tanggapan> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tanggapan|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tanggapan saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tanggapan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tanggapan>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tanggapan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tanggapan> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tanggapan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tanggapan>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tanggapan>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tanggapan> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TanggapanTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tanggapan');
        $this->setDisplayField('isi_laporan');
        $this->setPrimaryKey('id');

        $this->belongsTo('Petugas', [
            'foreignKey' => 'petugas_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pengaduan', [
            'foreignKey' => 'pengaduan_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->dateTime('tg_tanggapan')
            ->requirePresence('tg_tanggapan', 'create')
            ->notEmptyDateTime('tg_tanggapan');

        $validator
            ->scalar('isi_laporan')
            ->maxLength('isi_laporan', 1000)
            ->requirePresence('isi_laporan', 'create')
            ->notEmptyString('isi_laporan');

        $validator
            ->integer('petugas_id')
            ->notEmptyString('petugas_id');

        $validator
            ->integer('pengaduan_id')
            ->notEmptyString('pengaduan_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['petugas_id'], 'Petugas'), ['errorField' => 'petugas_id']);
        $rules->add($rules->existsIn(['pengaduan_id'], 'Pengaduan'), ['errorField' => 'pengaduan_id']);

        return $rules;
    }
}
