<?php

namespace App\Http\Controllers\Dictionary\Models;


class DictionaryWord
{
    /** @var string */
    public $word;
    /** @var string */
    public $dictionary;
    /** @var bool */
    public $convertible;
    /** @var bool */
    public $skip;

    public function __construct(string $word, string $dictionary, bool $convertible)
    {
        $this->word = $word;
        $this->dictionary = $dictionary;
        $this->convertible = $convertible;

        $this->skip = false;
    }
}
