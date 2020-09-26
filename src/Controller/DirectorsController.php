<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Directors Controller
 *
 * @property \App\Model\Table\DirectorsTable $Directors
 * @method \App\Model\Entity\Director[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $directors = $this->paginate($this->Directors);

        $this->set(compact('directors'));
    }

    /**
     * View method
     *
     * @param string|null $id Director id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $director = $this->Directors->get($id, [
            'contain' => ['Movies'],
        ]);

        $this->set(compact('director'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $director = $this->Directors->newEmptyEntity();
        if ($this->request->is('post')) {
            $director = $this->Directors->patchEntity($director, $this->request->getData());
            if ($this->Directors->save($director)) {
                $this->Flash->success(__('The director has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The director could not be saved. Please, try again.'));
        }
        $this->set(compact('director'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Director id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $director = $this->Directors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $director = $this->Directors->patchEntity($director, $this->request->getData());
            if ($this->Directors->save($director)) {
                $this->Flash->success(__('The director has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The director could not be saved. Please, try again.'));
        }
        $this->set(compact('director'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Director id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $director = $this->Directors->get($id);
        if ($this->Directors->delete($director)) {
            $this->Flash->success(__('The director has been deleted.'));
        } else {
            $this->Flash->error(__('The director could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
