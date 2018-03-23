<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Corp\Menu;
use Illuminate\Support\Facades\Config;

class IndexController extends SiteController
{
    public function __construct(SlidersRepository $rep, PortfoliosRepository $prep, ArticlesRepository $arep)
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->p_rep = $prep;
        $this->s_rep = $rep;
        $this->a_rep = $arep;
        $this->bar = 'right';
        $this->template = env('THEME')  .  '.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderItems = $this->getSliders();
        $sliders = view(env('THEME') . '.slider')->with('sliders', $sliderItems)->render();
        $this->vars['sliders'] = $sliders;

        $portfolio = $this->getPortfolio();
        $content = view(env('THEME') . '.content')->with('portfolios', $portfolio)->render();
        $this->vars['content'] = $content;

        $articles = $this->getArticles();
        //dd($articles);
        $this->contentRightBar = view(env('THEME') . '.indexBar')->with('articles', $articles)->render();

        return $this->renderOutput();
    }

    public function getSliders()
    {
        $sliders = $this->s_rep->get();

        if($sliders->isEmpty()){
            return FALSE;
        }
        $sliders->transform(function ($item, $key){
            $item->img = Config::get('settings.slider_path') . '/' . $item->img;
            return $item;
        });
        //dd($sliders);
        return $sliders;
    }

    protected function getPortfolio()
    {
        $portfolio = $this->p_rep->get('*', Config::get('settings.home_port_count'));
        return $portfolio;
    }

    protected function getArticles()
    {   $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias'], Config::get('settings.home_articles_count'));
        return $articles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
