<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\MenusRepository;
use Corp\Menu;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $prep, ArticlesRepository $arep, CommentsRepository $crep)
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $prep;
        $this->s_rep = $crep;
        $this->a_rep = $arep;
        $this->bar = 'right';
        $this->template = env('THEME')  .  '.articles';
    }

    public function index($cat_alias=FALSE)
    {
        $articles = $this->getArticles($cat_alias);

        $this->title = "Blog";
        $this->keywords = "Blog";
        $this->meta_desc = "Blog";

        $content = view(env('THEME') . '.articles_content')->with('articles', $articles)->render();
        $this->vars['content'] = $content;

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        //dd($comments);
        $this->contentRightBar = view(env('THEME') . '.articlesBar')->with(['portfolios'=>$portfolios, 'comments'=>$comments])->render();

        return $this->renderOutput();
    }

    public function show($alias=FALSE)
    {
        $article = $this->a_rep->one($alias, ['comments' => TRUE]);

        $this->title = $article->title;
        $this->keywords = $article->keywords;
        $this->meta_desc = $article->meta_desc;

        if($article){
            $article->img = json_decode($article->img);
        }
        //dd($article->comments->groupBy('parent_id'));

        $content = view(env('THEME') . '.article_content')->with('article', $article)->render();
        $this->vars['content'] = $content;

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        $this->contentRightBar = view(env('THEME') . '.articlesBar')->with(['portfolios'=>$portfolios, 'comments'=>$comments])->render();

        return $this->renderOutput();
    }

    protected function getArticles($alias = FALSE)
    {
        $where = FALSE;
        if($alias)
        {
            $id = Category::select('id')->where('alias', '=' ,$alias)->first()->id;
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias', 'desc', 'user_id', 'category_id', 'id', 'keywords', 'meta_desc'], false, true, $where);
        if($articles)
        {
            $articles->load('user', 'category', 'comments');
        }
        return $articles;
    }

    protected function getPortfolios($numberOfRecords)
    {
        $portfolio = $this->p_rep->get(['title', 'text', 'alias', 'customer', 'img', 'filter_alias'], $numberOfRecords);
        return $portfolio;
    }

    protected function getComments($numberOfRecords)
    {
        $comments = $this->s_rep->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $numberOfRecords);
        if($comments)
        {
            $comments->load('article', 'user');
        }
        return $comments;
    }
}
