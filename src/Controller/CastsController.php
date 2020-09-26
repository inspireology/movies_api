<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Casts Controller
 *
 * @property \App\Model\Table\CastsTable $Casts
 * @method \App\Model\Entity\Cast[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CastsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actors', 'Movies'],
        ];
        $casts = $this->paginate($this->Casts);

        $this->set(compact('casts'));
    }

    /**
     * View method
     *
     * @param string|null $id Cast id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cast = $this->Casts->get($id, [
            'contain' => ['Actors', 'Movies'],
        ]);

        $this->set(compact('cast'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cast = $this->Casts->newEmptyEntity();
        if ($this->request->is('post')) {
            $cast = $this->Casts->patchEntity($cast, $this->request->getData());
            if ($this->Casts->save($cast)) {
                $this->Flash->success(__('The cast has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cast could not be saved. Please, try again.'));
        }
        $actors = $this->Casts->Actors->find('list', ['limit' => 200]);
        $movies = $this->Casts->Movies->find('list', ['limit' => 200]);
        $this->set(compact('cast', 'actors', 'movies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cast id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cast = $this->Casts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cast = $this->Casts->patchEntity($cast, $this->request->getData());
            if ($this->Casts->save($cast)) {
                $this->Flash->success(__('The cast has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cast could not be saved. Please, try again.'));
        }
        $actors = $this->Casts->Actors->find('list', ['limit' => 200]);
        $movies = $this->Casts->Movies->find('list', ['limit' => 200]);
        $this->set(compact('cast', 'actors', 'movies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cast id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cast = $this->Casts->get($id);
        if ($this->Casts->delete($cast)) {
            $this->Flash->success(__('The cast has been deleted.'));
        } else {
            $this->Flash->error(__('The cast could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
