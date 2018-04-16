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

    public function show($alias)
    {
        $portfolio = $this->p_rep->one($alias);

        $this->title = $portfolio->title;
        $this->keywords = "Портфолио";
        $this->meta_desc = "Портфолио";

        if($portfolio && $portfolio->img){
            $portfolio->img = json_decode($portfolio->img);
        }

        $portfolios = $this->getPortfolios(config('settings.other_portfolios'), false);

        $content = view(env('THEME') . '.portfolio_content')->with(['portfolios'=>$portfolios, 'portfolio'=>$portfolio])->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }

    protected function getPortfolios($numberOfRecords = false, $paginate = true)
    {
        $portfolios = $this->p_rep->get('*', $numberOfRecords, $paginate);
        if($portfolios){
            $portfolios->load('filter');
        }
        return $portfolios;
    }
}
