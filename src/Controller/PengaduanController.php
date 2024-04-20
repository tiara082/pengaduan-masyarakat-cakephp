<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\PetugasTable;
use Cake\View\ViewBuilder;


/**
 * Pengaduan Controller
 *
 * @property \App\Model\Table\PengaduanTable $Pengaduan
 */
class PengaduanController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function export()
    {
        // Fetch data from Pengaduan table
        $pengaduan = $this->Pengaduan->find()->toArray();
    
        // Remove 'foto' field from the data as requested
        foreach ($pengaduan as &$data) {
            unset($data['foto']);
        }
    
        // Set options for CSV export
        $serialize = 'pengaduan';
        $delimiter = ',';
        $enclosure = '"';
        $newline = "\r\n"; // Gunakan petik ganda untuk karakter newline
        $header = ['ID', 'Tanggal Pengaduan', 'Isi Laporan', 'Status', 'Petugas ID'];
    
        $this->setResponse($this->getResponse()->withDownload('pengaduan.csv'));
        $this->set(compact('pengaduan', 'header'));
        $this->viewBuilder()
             ->setClassName('CsvView.Csv')
             ->setOptions(compact('serialize', 'delimiter', 'enclosure', 'newline', 'header')); // Sertakan 'header' dalam setOptions

    }
     public function index()
    {
        $userLevel = $this->Authentication->getIdentity()->get('level');
        $userId = $this->Authentication->getIdentity()->get('id');
        
        if ($userLevel == 'masyarakat') {
            // Tampilkan pengaduan yang dibuat oleh pengguna yang sedang login jika levelnya adalah 'masyarakat'
            $query = $this->Pengaduan->find()
                ->where(['Pengaduan.petugas_id' => $userId])
                ->contain(['Petugas']);
        } else {
            // Tampilkan semua pengaduan jika level pengguna adalah 'petugas' atau 'admin'
            $query = $this->Pengaduan->find()->contain(['Petugas']);
        }
    
        $pengaduan = $this->paginate($query);
    
        $this->set(compact('pengaduan'));
    }
    
    /**
     * View method
     *
     * @param string|null $id Pengaduan id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pengaduan = $this->Pengaduan->get($id, contain: ['Petugas', 'Tanggapan']);
        $data = $this->Pengaduan->Petugas->find('list')->all();
        $petugas = $data->toArray();
        $this->set(compact('pengaduan','petugas'));


    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pengaduan = $this->Pengaduan->newEmptyEntity();
        if ($this->request->is('post')) {
            $pengaduan = $this->Pengaduan->patchEntity($pengaduan, $this->request->getData());
            $file = $this->request->getUploadedFiles();

            $pengaduan->foto = $file['images']->getClientFilename();
            $file['images']->moveTo(WWW_ROOT . 'img' . DS .'pengaduan' . DS . $pengaduan->foto);

            if ($this->Pengaduan->save($pengaduan)) {
                $this->Flash->success(__('The pengaduan has been saved.'));


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pengaduan could not be saved. Please, try again.'));
        }
        $petugas = $this->Pengaduan->Petugas->find('list', limit: 200)->all();
        $this->set(compact('pengaduan', 'petugas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pengaduan id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pengaduan = $this->Pengaduan->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pengaduan = $this->Pengaduan->patchEntity($pengaduan, $this->request->getData());
            
            $file = $this->request->getUploadedFiles();
            
            if(!empty($file['images']->getClientFilename())){
                $pengaduan->foto = $file['images']->getClientFilename();
                $file['images']->moveTo(WWW_ROOT . 'img' . DS .'pengaduan' . DS . $pengaduan->foto);
            }
            if ($this->Pengaduan->save($pengaduan)) {
                $this->Flash->success(__('The pengaduan has been saved.'));


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pengaduan could not be saved. Please, try again.'));
        }
        $petugas = $this->Pengaduan->Petugas->find('list', limit: 200)->all();
        $this->set(compact('pengaduan', 'petugas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pengaduan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pengaduan = $this->Pengaduan->get($id);
        $cekTanggapan = $this->Pengaduan->Tanggapan->find()->where(['pengaduan_id'=>$id])->count();
        if(empty($cekTanggapan)){
            if ($this->Pengaduan->delete($pengaduan)) {
                $this->Flash->success(__('The pengaduan has been deleted.'));
            } else {
                $this->Flash->error(__('The pengaduan could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->warning(__('Error! Please check again '.$pengaduan->isi_laporan));
        }


        return $this->redirect(['action' => 'index']);
    }
}