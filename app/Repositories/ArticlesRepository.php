<?php

namespace Corp\Repositories;
use Corp\Repositories;
use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function one($alias, $relation = [])
    {   $article = parent::one($alias, $relation);

        if($article && !empty($relation))
        {
            //$article->load('comments');
            //$article->comments->load('user');
            //заменим на одну строку кода
            $article->load('comments.user');
        }

        return $article;
    }
}