<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Websites', 'Materials', 'ChangedMaterials', 'MaterialColors', 'ChangedMaterialColors', 'Surfaces', 'ChangedSurfaces', 'DiamondColors', 'ChangedDiamondColors', 'DiamondClarities', 'ChangedDiamondClarities', 'Stones', 'Actions', 'MasterCategories', 'Genders', 'ChangedGenders', 'Occasions', 'ChangedOccasions', 'Styles', 'Chains', 'Clasps', 'MetalAndColors']
        ];
        $items = $this->paginate($this->Items);

        $this->set(compact('items'));
        $this->set('_serialize', ['items']);
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Websites', 'Materials', 'ChangedMaterials', 'MaterialColors', 'ChangedMaterialColors', 'Surfaces', 'ChangedSurfaces', 'DiamondColors', 'ChangedDiamondColors', 'DiamondClarities', 'ChangedDiamondClarities', 'Stones', 'Actions', 'MasterCategories', 'Genders', 'ChangedGenders', 'Occasions', 'ChangedOccasions', 'Styles', 'Chains', 'Clasps', 'MetalAndColors', 'ItemFilterMetalAndColors', 'ItemFilterStones', 'ItemLengths', 'ItemMetalAndColors', 'ItemNecklaceTypes', 'ItemOccasions', 'ItemStones', 'ItemTags']
        ]);

        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item could not be saved. Please, try again.'));
            }
        }
        $websites = $this->Items->Websites->find('list', ['limit' => 200]);
        $materials = $this->Items->Materials->find('list', ['limit' => 200]);
        $changedMaterials = $this->Items->ChangedMaterials->find('list', ['limit' => 200]);
        $materialColors = $this->Items->MaterialColors->find('list', ['limit' => 200]);
        $changedMaterialColors = $this->Items->ChangedMaterialColors->find('list', ['limit' => 200]);
        $surfaces = $this->Items->Surfaces->find('list', ['limit' => 200]);
        $changedSurfaces = $this->Items->ChangedSurfaces->find('list', ['limit' => 200]);
        $diamondColors = $this->Items->DiamondColors->find('list', ['limit' => 200]);
        $changedDiamondColors = $this->Items->ChangedDiamondColors->find('list', ['limit' => 200]);
        $diamondClarities = $this->Items->DiamondClarities->find('list', ['limit' => 200]);
        $changedDiamondClarities = $this->Items->ChangedDiamondClarities->find('list', ['limit' => 200]);
        $stones = $this->Items->Stones->find('list', ['limit' => 200]);
        $actions = $this->Items->Actions->find('list', ['limit' => 200]);
        $masterCategories = $this->Items->MasterCategories->find('list', ['limit' => 200]);
        $genders = $this->Items->Genders->find('list', ['limit' => 200]);
        $changedGenders = $this->Items->ChangedGenders->find('list', ['limit' => 200]);
        $occasions = $this->Items->Occasions->find('list', ['limit' => 200]);
        $changedOccasions = $this->Items->ChangedOccasions->find('list', ['limit' => 200]);
        $styles = $this->Items->Styles->find('list', ['limit' => 200]);
        $chains = $this->Items->Chains->find('list', ['limit' => 200]);
        $clasps = $this->Items->Clasps->find('list', ['limit' => 200]);
        $metalAndColors = $this->Items->MetalAndColors->find('list', ['limit' => 200]);
        $this->set(compact('item', 'websites', 'materials', 'changedMaterials', 'materialColors', 'changedMaterialColors', 'surfaces', 'changedSurfaces', 'diamondColors', 'changedDiamondColors', 'diamondClarities', 'changedDiamondClarities', 'stones', 'actions', 'masterCategories', 'genders', 'changedGenders', 'occasions', 'changedOccasions', 'styles', 'chains', 'clasps', 'metalAndColors'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->data);
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item could not be saved. Please, try again.'));
            }
        }
        $websites = $this->Items->Websites->find('list', ['limit' => 200]);
        $materials = $this->Items->Materials->find('list', ['limit' => 200]);
        $changedMaterials = $this->Items->ChangedMaterials->find('list', ['limit' => 200]);
        $materialColors = $this->Items->MaterialColors->find('list', ['limit' => 200]);
        $changedMaterialColors = $this->Items->ChangedMaterialColors->find('list', ['limit' => 200]);
        $surfaces = $this->Items->Surfaces->find('list', ['limit' => 200]);
        $changedSurfaces = $this->Items->ChangedSurfaces->find('list', ['limit' => 200]);
        $diamondColors = $this->Items->DiamondColors->find('list', ['limit' => 200]);
        $changedDiamondColors = $this->Items->ChangedDiamondColors->find('list', ['limit' => 200]);
        $diamondClarities = $this->Items->DiamondClarities->find('list', ['limit' => 200]);
        $changedDiamondClarities = $this->Items->ChangedDiamondClarities->find('list', ['limit' => 200]);
        $stones = $this->Items->Stones->find('list', ['limit' => 200]);
        $actions = $this->Items->Actions->find('list', ['limit' => 200]);
        $masterCategories = $this->Items->MasterCategories->find('list', ['limit' => 200]);
        $genders = $this->Items->Genders->find('list', ['limit' => 200]);
        $changedGenders = $this->Items->ChangedGenders->find('list', ['limit' => 200]);
        $occasions = $this->Items->Occasions->find('list', ['limit' => 200]);
        $changedOccasions = $this->Items->ChangedOccasions->find('list', ['limit' => 200]);
        $styles = $this->Items->Styles->find('list', ['limit' => 200]);
        $chains = $this->Items->Chains->find('list', ['limit' => 200]);
        $clasps = $this->Items->Clasps->find('list', ['limit' => 200]);
        $metalAndColors = $this->Items->MetalAndColors->find('list', ['limit' => 200]);
        $this->set(compact('item', 'websites', 'materials', 'changedMaterials', 'materialColors', 'changedMaterialColors', 'surfaces', 'changedSurfaces', 'diamondColors', 'changedDiamondColors', 'diamondClarities', 'changedDiamondClarities', 'stones', 'actions', 'masterCategories', 'genders', 'changedGenders', 'occasions', 'changedOccasions', 'styles', 'chains', 'clasps', 'metalAndColors'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
