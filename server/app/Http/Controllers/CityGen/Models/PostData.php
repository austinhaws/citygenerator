<?php

namespace App\Http\Controllers\CityGen\Models;

class PostData {

    /** @var string */
    public $populationType;


    /**
     * PostData constructor.
     * @param string $_post post data to convert to this object
     */
    public function __construct(string $_post = null)
    {
        if ($_post) {
            $this->populationType = $_post['population_type'];
        }
    }
}
