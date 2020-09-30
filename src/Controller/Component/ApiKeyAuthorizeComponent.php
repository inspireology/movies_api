<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ApiKeyAuthorizeComponent extends Component
{
    // load the api key model and query that the key exists
    public function authorize()
    {
        $controller = $this->getController();
        $apiKeyFromRequestHeader = $controller->getRequest()->getHeaderLine('X-API-KEY');

        return $this->apiKeyIsAllowed($apiKeyFromRequestHeader);
    }

    public function apiKeyIsAllowed($apiKey)
    {
        $controller = $this->getController();
        $apiTable = $controller->getTableLocator()->get('Api');

        if(!$apiTable->isValidApiKey($apiKey)) {
            $controller->setAction('invalidApiKey');
        }
    }
}
