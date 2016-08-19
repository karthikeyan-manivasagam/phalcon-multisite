<?php

namespace Common\Models;

use Phalcon\Mvc\Collection;


class Article extends Collection
{
    public function getSource()
    {
        return "article";
    }	

}
