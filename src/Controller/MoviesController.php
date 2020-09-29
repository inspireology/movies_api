<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;

/**
 * Movies Controller
 *
 * @property \App\Model\Table\MoviesTable $Movies
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MoviesController extends AppController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        try {
            $this->loadComponent('RequestHandler');
            $this->loadComponent('ApiKeyAuthorize');
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
            'contain' => ['Ratings', 'Directors', 'Genres'],
        ];

        $movies = $this->paginate($this->Movies);

        $this->set(compact('movies'));
        $this->viewBuilder()->setOption('serialize', ['movies']);
    }

    /**
     * View method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $movie = $this->Movies->get($id, [ 'contain' => ['Ratings', 'Directors', 'Genres', 'Casts', 'Favorites'], ]);
        } catch (RecordNotFoundException $exception) {
            $this->ApiResponse->errorRowNotFoundResponse();
            return;
        }

        $this->set(compact('movie'));
        $this->viewBuilder()->setOption('serialize', ['movie']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movie = $this->Movies->newEmptyEntity();
        if ($this->request->is('post')) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $ratings = $this->Movies->Ratings->find('list', ['limit' => 200]);
        $directors = $this->Movies->Directors->find('list', ['limit' => 200]);
        $genres = $this->Movies->Genres->find('list', ['limit' => 200]);
        $this->set(compact('movie', 'ratings', 'directors', 'genres'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movie = $this->Movies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $ratings = $this->Movies->Ratings->find('list', ['limit' => 200]);
        $directors = $this->Movies->Directors->find('list', ['limit' => 200]);
        $genres = $this->Movies->Genres->find('list', ['limit' => 200]);
        $this->set(compact('movie', 'ratings', 'directors', 'genres'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movie = $this->Movies->get($id);
        if ($this->Movies->delete($movie)) {
            $this->Flash->success(__('The movie has been deleted.'));
        } else {
            $this->Flash->error(__('The movie could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Search using the 'search' query parameter or find most popular movies
     */
    public function searchOrFindPopular()
    {

    }

    /**
     * Final all of the users previous favorites
     */
    public function findAllUserFavorites()
    {

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
