<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Menu;
use Illuminate\Http\Request;

class PortfolioController extends SiteController
{
    public function __construct(PortfoliosRepository $prep)
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $prep;
        $this->bar = 'no';
        $this->template = env('THEME')  .  '.portfolios';
    }

    public function index()
    {
        $this->title = "Портфолио";
        $this->keywords = "Портфолио";
        $this->meta_desc = "Портфолио";

        $portfolios = $this->getPortfolios();

        $content = view(env('THEME') . '.content_portfolios')->with('portfolios', $portfolios)->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }

    public function show(){

    }

    protected function getPortfolios()
    {
        $portfolios = $this->p_rep->get('*', false, true);
        if($portfolios){
            $portfolios->load('filter');
        }
        return $portfolios;
    }
}
