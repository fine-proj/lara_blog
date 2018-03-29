<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\MenusRepository;
use Corp\Menu;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $prep, ArticlesRepository $arep)
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->p_rep = $prep;
        $this->a_rep = $arep;
        $this->bar = 'right';
        $this->template = env('THEME')  .  '.articles';
    }

    public function index()
    {
        $articles = $this->getArticles();
        $content = view(env('THEME') . '.articles_content')->with('articles', $articles)->render();
        $this->vars['content'] = $content;
        return $this->renderOutput();
    }

    protected function getArticles($alias = FALSE)
    {
        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias', 'desc', 'user_id', 'category_id', 'id'], false, true);
        if($articles)
        {
            //$articles->load('user', 'category', 'comments');
        }
        return $articles;
    }
}
