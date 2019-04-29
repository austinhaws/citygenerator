<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Models\Post\PostRaceRatio;

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
            $postData->hasSea = $this->services->random->randomBoolean($post, 'sea');
            $postData->hasMilitary = $this->services->random->randomBoolean($post, 'military');
            $postData->hasRiver = $this->services->random->randomBoolean($post, 'river');
            $postData->hasGates = $this->services->random->randomBoolean($post, 'numGates');
            $postData->generateBuildings = $this->services->random->randomBoolean($post, 'buildings');
            $postData->racialMix = isset($post['racialMix']) ? $post['racialMix'] : [];
            if (isset($post['raceRatios'])) {
                $postData->raceRatio = array_map(function ($ratio) {
                    return new PostRaceRatio($ratio['race'], floatval($ratio['ratio']) / 100.0);
                }, $post['raceRatios']);
            }
            $postData->wardsAdded = isset($post['wardsAdded']) ? $post['wardsAdded'] : [];
            $postData->professions = $this->services->random->randomBoolean($post, 'professions');
        } else {
            $postData->populationType = null;
            $postData->hasSea = BooleanRandom::RANDOM;
            $postData->hasMilitary = BooleanRandom::RANDOM;
            $postData->hasRiver = BooleanRandom::RANDOM;
            $postData->hasGates = BooleanRandom::RANDOM;
            $postData->generateBuildings = BooleanRandom::RANDOM;
            $postData->racialMix = [];
            $postData->wardsAdded = [];
            $postData->professions = BooleanRandom::RANDOM;
        }

        return $postData;
    }
}
