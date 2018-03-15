<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;

class SiteController extends Controller{

    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    protected $template;

    protected $vars = [];

    protected $bar;
    protected $contentLeftBar;
    protected $contentRightBar;

    public function __construct(MenusRepository $m){
        $this->m_rep = $m;
    }

    public function renderOutput(){
        $menu = $this->getMenu();
        dd($menu);

        $navigation = view(env('THEME') . '.navigation')->render();
        $this->vars['navigation'] = $navigation;
        return view($this->template)->with($this->vars);
    }

    public function getMenu()
    {
        $menu = $this->m_rep->get();
        return $menu;
    }
}
