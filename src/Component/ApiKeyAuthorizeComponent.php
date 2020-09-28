<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class ApiKeyAuthorizeComponent extends Component
{
    // load the api key model and query that the key exists
    public function apiKeyAuthorize()
    {
        $apiKeyFromRequestHeader = $this->getController()->request->getHeaderLine('X-API-KEY');
        if($this->apiKeyIsAllowed($apiKeyFromRequestHeader)) {
            // do nothing
        }
    }

    public function apiKeyIsAllowed($apiKey)
    {
        $apiTable = $this->getTableLocator()->get('Api');
        return $apiTable->isValidApiKey($apiKey);
    }
}
