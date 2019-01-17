<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Models\PostData;

class PostDataService extends BaseService
{
    /**
     * @param array $post
     * @return PostData
     */
    public function createPostData(array $post)
    {
        $postData = new PostData();

        if ($post) {
            $postData->populationType = isset($post['populationType']) ? $post['populationType'] : null;
            $postData->hasSea = $this->services->randomService->randomBoolean($post, 'sea');
            $postData->hasMilitary = $this->services->randomService->randomBoolean($post, 'military');
            $postData->hasRiver = $this->services->randomService->randomBoolean($post, 'river');
            $postData->hasGates = $this->services->randomService->randomBoolean($post, 'gates');
        }
        return $postData;
    }
}
