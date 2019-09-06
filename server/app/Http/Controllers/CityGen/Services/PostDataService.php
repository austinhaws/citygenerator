<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Models\Post\PostRaceRatio;
use App\Http\Controllers\CityGen\Models\Post\WardAdded;
use App\Http\Controllers\CityGen\Models\Table\TableBuilding;

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
            $postData->generateBuildings = (isset($post['buildings']) && $post['buildings'] === 'custom') ? BooleanRandom::TRUE : $this->services->random->randomBoolean($post, 'buildings');
            $postData->racialMix = isset($post['racialMix']) ? $post['racialMix'] : [];
            if (isset($post['raceRatios'])) {
                $postData->raceRatio = array_map(function ($ratio) {
                    return new PostRaceRatio($ratio['race'], floatval($ratio['ratio']) / 100.0);
                }, $post['raceRatios']);
            }
            $postData->wardsAdded = isset($post['wardsAdded']) ? array_map(function ($wardAdded) {
                return new WardAdded($wardAdded['buildings'], $wardAdded['ward']);
            }, $post['wardsAdded']) : [];
            if (isset($post['buildings']) && $post['buildings'] === 'custom') {
                foreach ($postData->wardsAdded as $wardKey => $wardAdded) {
                    $weightCount = 0;
                    $weightedBuildings = [];
                    foreach ($wardAdded->buildings as $building) {
                        $weight = intval($building['weight']);
                        // ignore invalid buildings weights
                        if ($weight > 0) {
                            $weightCount += $weight;
                            $weightedBuildings[$weightCount] = new TableBuilding($building['type'], new MinMax(1, 4));
                        }
                    }
                    $postData->wardsAdded[$wardKey]->buildings = $weightedBuildings;
                }
            }
            $postData->professions = $this->services->random->randomBoolean($post, 'professions');
        } else {
            $postData->populationType = null;
            $postData->hasSea = BooleanRandom::RANDOM;
            $postData->hasMilitary = BooleanRandom::RANDOM;
            $postData->hasRiver = BooleanRandom::RANDOM;
            $postData->hasGates = BooleanRandom::RANDOM;
            $postData->generateBuildings = BooleanRandom::TRUE;
            $postData->racialMix = [];
            $postData->wardsAdded = [];
            $postData->professions = BooleanRandom::TRUE;
        }

        return $postData;
    }
}
