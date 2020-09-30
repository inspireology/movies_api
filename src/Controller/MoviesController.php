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
            $movie = $this->Movies->get($id, ['contain' => ['Ratings', 'Directors', 'Genres', 'Casts' => ['Actors'], 'Favorites' => ['Users']]]);
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
        $searchQuery = $this->request->getQuery('search');

        if ($searchQuery) {
            $this->searchBySearchQuery($searchQuery);
        } else {
            $this->searchByPopularity();
        }
    }

    /**
     * @param $searchQuery string A url encoded, json encoded string of search parameters
     */
    public function searchBySearchQuery($searchQuery)
    {
        // TODO: This logic should be moved in to a component as skinny controllers are good
        $searchParameters = json_decode(urldecode($searchQuery));

        $query = $this->Movies->find();

        // filter by words in title
        if (property_exists($searchParameters, 'title_has_words')) {
            foreach ($searchParameters->title_has_words as $searchTitleWord) {
                $query->where(['title LIKE' => "%$searchTitleWord%"]);
            }
        }

        // filter by words in description
        if (property_exists($searchParameters, 'description_has_words')) {
            foreach ($searchParameters->title_has_words as $searchDescriptionWord) {
                $query->where(['description LIKE' => "%$searchDescriptionWord%"]);
            }
        }

        // filter by the age restriction rating (see rating table for value)
        if (property_exists($searchParameters, 'rating_id')) {
            $query->where(['rating_id' => $searchParameters->rating_id]);
        }

        // filter by duration in seconds (longer than)
        if (property_exists($searchParameters, 'duration_longer_than')) {
            $query->where(['duration >' => $searchParameters->duration_longer_than]);
        }

        // filter by duration in seconds (shorter than)
        if (property_exists($searchParameters, 'duration_longer_than')) {
            $query->where(['duration >' => $searchParameters->duration_shorter_than]);
        }

        // Additional search filters can be added here

        $movies = $query->all();
        $this->set(compact('movies'));
        $this->viewBuilder()->setOption('serialize', ['movies']);
    }

    /**
     * Search for movies by how many likes they have
     */
    public function searchByPopularity()
    {
        $query = $this->Movies->find();

        $query->select([
            'id' => 'm.id',
            'title' => 'm.title',
            'description' => 'm.description',
            'favorites_count' => 'count(f.id)',
        ])
            ->from('movies AS m')
            ->join([
                'table' => 'favorites',
                'alias' => 'f',
                'type' => 'inner',
                'conditions' => 'm.id = f.movie_id'
            ])
            ->group(['m.id'])
            ->order(['favorites_count' => 'DESC']);

        $movies = $query->all();
        $this->set(compact('movies'));
        $this->viewBuilder()->setOption('serialize', ['movies']);
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
