<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Jewelries Controller
 *
 * @property \App\Model\Table\JewelriesTable $Jewelries
 */
class JewelriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $jewelries = $this->paginate($this->Jewelries);

        $this->set(compact('jewelries'));
        $this->set('_serialize', ['jewelries']);
    }

    /**
     * View method
     *
     * @param string|null $id Jewelry id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jewelry = $this->Jewelries->get($id, [
            'contain' => []
        ]);

        $this->set('jewelry', $jewelry);
        $this->set('_serialize', ['jewelry']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jewelry = $this->Jewelries->newEntity();
        if ($this->request->is('post')) {
            $jewelry = $this->Jewelries->patchEntity($jewelry, $this->request->data);
            if ($this->Jewelries->save($jewelry)) {
                $this->Flash->success(__('The jewelry has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The jewelry could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('jewelry'));
        $this->set('_serialize', ['jewelry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jewelry id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jewelry = $this->Jewelries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jewelry = $this->Jewelries->patchEntity($jewelry, $this->request->data);
            if ($this->Jewelries->save($jewelry)) {
                $this->Flash->success(__('The jewelry has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The jewelry could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('jewelry'));
        $this->set('_serialize', ['jewelry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jewelry id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jewelry = $this->Jewelries->get($id);
        if ($this->Jewelries->delete($jewelry)) {
            $this->Flash->success(__('The jewelry has been deleted.'));
        } else {
            $this->Flash->error(__('The jewelry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
