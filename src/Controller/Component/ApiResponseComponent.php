<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ApiResponseComponent extends Component
{
    private $controller;
    private $response;

    private $contentType = "application/json";
    private $responseCode = "";

    private $errorTemplate = [
        ['headers' => []],
        'message' => '',
        'errors' => ''
    ];

    public function errorRowNotFoundResponse()
    {
        $error = 'ERROR_ROW_NOT_FOUND';
        $message = "Specified row does not exist in the database.";

        $this->controller->setResponse($this->response->withStatus(404));

        $this->controller->set(compact('error'));
        $this->controller->set(compact('message'));
        $this->controller->viewBuilder()->setOption('serialize', ['error', 'message']);
    }

    public function errorApiEndpointNotFoundResponse()
    {
        $error = 'ERROR_ENDPOINT_NOT_FOUND';
        $message = "The specified endpoint does not exist.";

        $this->controller->setResponse($this->response->withStatus(404));

        $this->controller->set(compact('error'));
        $this->controller->set(compact('message'));
        $this->controller->viewBuilder()->setOption('serialize', ['error', 'message']);
    }

    public function errorFavoriteAddFailure($message = 'There was an error adding your favorite, please try again.')
    {
        $error = 'ERROR_FAVORITE_ADD_FAILURE';

        $this->controller->setResponse($this->response->withStatus(404));

        $this->controller->set(compact('error'));
        $this->controller->set(compact('message'));
        $this->controller->viewBuilder()->setOption('serialize', ['error', 'message']);
    }

    public function okSaveSuccessful($message = 'Save was successful.')
    {
        $this->controller->setResponse($this->response->withStatus(201));

        $this->controller->set(compact('message'));
        $this->controller->viewBuilder()->setOption('serialize', ['message']);
    }

    public function apiKeyInvalidResponse()
    {
        $error = 'ERROR_API_KEY_INVALID';
        $message = "The specified API Key is not valid.";

        $this->controller->setResponse($this->response->withStatus(404));

        $this->controller->set(compact('error'));
        $this->controller->set(compact('message'));
        $this->controller->viewBuilder()->setOption('serialize', ['error', 'message']);
    }

    public function initialize($array = []): void
    {
        parent::initialize([]);

        $this->controller = $this->getController();
        $this->response = $this->controller->getResponse();
    }
}

