<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 * @method \App\Model\Entity\Favorite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FavoritesController extends AppController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        try {
            $this->loadComponent('RequestHandler');
            $this->loadComponent('ApiKeyAuthorize');
            $this->loadComponent('ApiResponse');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Movies'],
        ];
        $favorites = $this->paginate($this->Favorites);

        $this->set(compact('favorites'));
        $this->viewBuilder()->setOption('serialize', ['favorites']);
    }

    /**
     * View method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $favorite = $this->Favorites->get($id, [
            'contain' => ['Users', 'Movies'],
        ]);

        $this->set(compact('favorite'));
        $this->viewBuilder()->setOption('serialize', ['favorite']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($movieId = null)
    {
        $favorite = $this->Favorites->newEmptyEntity();
        $userId = $this->request->getHeaderLine('USER-ID');

        if (!(is_numeric($userId))) {
            $this->ApiResponse->errorFavoriteAddFailure("user_id is non-integer in header. Favorite could not be added");
            return;
        }

        if (!(is_numeric($movieId))) {
            $this->ApiResponse->errorFavoriteAddFailure("movie_id is non-integer. Favorite could not be added_");
            return;
        }

        $isValidUser = $this->getTableLocator()->get('Users')->findById($userId)->count();
        $isValidMovie = $this->getTableLocator()->get('Movies')->findById($movieId)->count();

        if (!($isValidMovie && $isValidUser)) {
            $this->ApiResponse->errorFavoriteAddFailure("user_id and movie_id must be valid entries in the database");
            return;
        }

        $favorite = $this->Favorites->patchEntity($favorite, ['user_id' => $userId, 'movie_id' => $movieId]);

        if ($this->Favorites->save($favorite)) {
            $this->ApiResponse->okSaveSuccessful();
        } else {
            $this->ApiResponse->errorFavoriteAddFailure("An unknown error has occured while saving");
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $favorite = $this->Favorites->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('The favorite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The favorite could not be saved. Please, try again.'));
        }
        $users = $this->Favorites->Users->find('list', ['limit' => 200]);
        $movies = $this->Favorites->Movies->find('list', ['limit' => 200]);
        $this->set(compact('favorite', 'users', 'movies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Favorite id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $favorite = $this->Favorites->get($id);
        if ($this->Favorites->delete($favorite)) {
            $this->Flash->success(__('The favorite has been deleted.'));
        } else {
            $this->Flash->error(__('The favorite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param EventInterface $event
     * @return \Cake\Http\Response|void|null
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        if ($this->ApiKeyAuthorize->authorize()) { // Check API key is valid and enabled
            // TODO: return a response and do not return any data
        }
    }

}
