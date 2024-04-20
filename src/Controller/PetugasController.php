<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\View\ViewBuilder;
use CakePdf\Pdf\CakePdf;
use Cake\Http\Response;
use Cake\Core\Configure;
/**
 * Petugas Controller
 *
 * @property \App\Model\Table\PetugasTable $Petugas
 */
class PetugasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
     public function exportPdf()
    {
        // Ambil data petugas dari model Petugas
        $petugas = $this->Petugas->find()->select(['id', 'nik', 'nama', 'username', 'telp', 'level']);

        // Konfigurasi CakePdf
        Configure::write('CakePdf', [
            'engine' => 'CakePdf.WkHtmlToPdf', // Gunakan engine WkHtmlToPdf
            'margin' => [
                'bottom' => 15,
                'left' => 50,
                'right' => 30,
                'top' => 45,
            ],
            'orientation' => 'landscape', // Orientasi landscape
            'download' => true, // Mengaktifkan opsi download
        ]);

        // Buat objek CakePdf
        $CakePdf = new CakePdf();
        $CakePdf->template('export_petugas', 'default'); // Gunakan template export_petugas.php
        $CakePdf->viewVars(['petugas' => $petugas]); // Kirim data petugas ke view

        // Dapatkan string PDF yang dihasilkan
        $pdf = $CakePdf->output();

        // Buat response PDF
        $response = new Response();
        $response = $response->withType('pdf');
        $response = $response->withStringBody($pdf);
        $response = $response->withDownload('petugas.pdf'); // Nama file PDF yang diunduh

        return $response;
    }
     public function export()
     {
         $petugas = $this->Petugas->find()->select(['id', 'nik', 'nama', 'username', 'telp', 'level']);
     
         // Set options for CSV export
         $serialize = 'petugas';
         $delimiter = ',';
         $enclosure = '"';
         $newline = "\r\n"; // Gunakan petik ganda untuk karakter newline
         $header = ['ID', 'NIK', 'Nama', 'Username', 'Telepon', 'Level'];
     
         $this->setResponse($this->getResponse()->withDownload('petugas.csv'));
         $this->set(compact('petugas', 'header'));
         $this->viewBuilder()
              ->setClassName('CsvView.Csv')
              ->setOptions(compact('serialize', 'delimiter', 'enclosure', 'newline', 'header')); // Sertakan 'header' dalam setOptions

        
     }
     
     
     public function index()
    {
        $level = $this->Authentication->getIdentity()->get('level');
        $id= $this->Authentication->getIdentity()->get('id');
        if($level=='admin'){
            $petugas = $this->paginate($this->Petugas);
        }else if($level=='petugas'){
            $petugas = $this->paginate($this->Petugas->find('all', ['conditions' => ['OR'=>['id'=>$id,'level'=>'masyarakat']]]));
        }else{
            $petugas = $this->Petugas->find('all', ['conditions' => ['id' => $id]]);
            $petugas = $this->paginate($petugas);
        }


        $this->set(compact('petugas'));
    }


    /**
     * View method
     *
     * @param string|null $id Petuga id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = $this->Authentication->getIdentity()->get('id');
        $petugas =$this->Petugas->find('all',['condition'=>['id ='=>$id]]);
        $petugas = $this->paginate($petugas);
        $petuga = $this->Petugas->get($id, contain: []);
        $this->set(compact('petuga'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $petuga = $this->Petugas->newEmptyEntity();
        if ($this->request->is('post')) {
            $petuga = $this->Petugas->patchEntity($petuga, $this->request->getData());
            if ($this->Petugas->save($petuga)) {
                $this->Flash->success(__('The petuga has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The petuga could not be saved. Please, try again.'));
        }
        $this->set(compact('petuga'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Petuga id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $petuga = $this->Petugas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $petuga = $this->Petugas->patchEntity($petuga, $this->request->getData());
            if ($this->Petugas->save($petuga)) {
                $this->Flash->success(__('The petuga has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The petuga could not be saved. Please, try again.'));
        }
        $this->set(compact('petuga'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Petuga id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $petuga = $this->Petugas->get($id);
        $idku = $this->Authentication->getIdentity()->get('id');
        if($id!=$idku){
            if ($this->Petugas->delete($petuga)) {
                $this->Flash->success(__('The petuga has been deleted.'));
            } else {
                $this->Flash->error(__('The petuga could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Mohon maaf anda tidak bisa menghapus akun anda sendiri, silahkan menghubungi admin untuk konfirmasi hapus data pengguna'));
        }


        return $this->redirect(['action' => 'index']);
    }



    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','register']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Petugas',
            'action' => 'index',
        ]);

        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}

public function register()
{
    $petuga = $this->Petugas->newEmptyEntity();
    if ($this->request->is('post')) {
        $petuga = $this->Petugas->patchEntity($petuga, $this->request->getData());
        if ($this->Petugas->save($petuga)) {
            $this->Flash->success(__('The petuga has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The petuga could not be saved. Please, try again.'));
    }
    $this->set(compact('petuga'));
}
public function logout()
{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged inbib
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Petugas', 'action' => 'login']);
    }
}
}
