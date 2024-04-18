<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tanggapan Controller
 *
 * @property \App\Model\Table\TanggapanTable $Tanggapan
 */
class TanggapanController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tanggapan->find()
            ->contain(['Petugas', 'Pengaduan']);
        $tanggapan = $this->paginate($query);

        $this->set(compact('tanggapan'));
    }

    /**
     * View method
     *
     * @param string|null $id Tanggapan id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tanggapan = $this->Tanggapan->get($id, contain: ['Petugas', 'Pengaduan']);
        $this->set(compact('tanggapan'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tanggapan = $this->Tanggapan->newEmptyEntity();
        if ($this->request->is('post')) {
            $tanggapan = $this->Tanggapan->patchEntity($tanggapan, $this->request->getData());
            if ($this->Tanggapan->save($tanggapan)) {
                $this->Flash->success(__('The tanggapan has been saved.'));

                return $this->redirect(['controller' => 'Pengaduan', 'action' => 'view/'.$tanggapan->pengaduan_id]);
            }
            $this->Flash->error(__('The tanggapan could not be saved. Please, try again.'));
        }
        $petugas = $this->Tanggapan->Petugas->find('list', limit: 200)->all();
        $pengaduan = $this->Tanggapan->Pengaduan->find('list', limit: 200)->all();
        $this->set(compact('tanggapan', 'petugas', 'pengaduan'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tanggapan id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tanggapan = $this->Tanggapan->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tanggapan = $this->Tanggapan->patchEntity($tanggapan, $this->request->getData());
            if ($this->Tanggapan->save($tanggapan)) {
                $this->Flash->success(__('The tanggapan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tanggapan could not be saved. Please, try again.'));
        }
        $petugas = $this->Tanggapan->Petugas->find('list', limit: 200)->all();
        $pengaduan = $this->Tanggapan->Pengaduan->find('list', limit: 200)->all();
        $this->set(compact('tanggapan', 'petugas', 'pengaduan'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tanggapan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tanggapan = $this->Tanggapan->get($id);
        if ($this->Tanggapan->delete($tanggapan)) {
            $this->Flash->success(__('The tanggapan has been deleted.'));
        } else {
            $this->Flash->error(__('The tanggapan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
