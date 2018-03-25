<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Lavary\Menu\Facade as Menu;

class SiteController extends Controller{

    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    protected $template;

    protected $vars = [];

    protected $bar = 'no';
    protected $contentLeftBar;
    protected $contentRightBar;

    protected $keywords;
    protected $meta_desc;
    protected $title;

    public function __construct(MenusRepository $m){
        $this->m_rep = $m;
    }

    public function renderOutput(){
        $menu = $this->getMenu();
        //dd($menu);

        $navigation = view(env('THEME') . '.navigation')->with('menu',$menu)->render();
        $this->vars['navigation'] = $navigation;

        if($this->contentRightBar)
        {
            $rightBar = view(env('THEME') . '.rightBar')->with('content_rightBar',$this->contentRightBar)->render();
            $this->vars['rightBar'] = $rightBar;
        }

        $this->vars['bar'] = $this->bar;

        $footer = view(env('THEME') . '.footer')->render();
        $this->vars['footer'] = $footer;

        $this->vars['keywords'] =  $this->keywords;
        $this->vars['meta_desc'] =  $this->meta_desc;
        $this->vars['title'] =  $this->title;

        return view($this->template)->with($this->vars);
    }

    public function getMenu()
    {
        $menu = $this->m_rep->get();
        $mBuilder = Menu::make('MyNav', function($m)use($menu){
            foreach($menu as $item)
            {
                if($item->parent == 0)
                {	$m->add( $item->title, $item->path )->id($item->id);
                }
                else
                {
                    if($m->find( $item->parent ))
                    {
                        $m->find( $item->parent )->add( $item->title, $item->path )->id($item->id);
                    }
                }
            }
        });
        //dd($mBuilder);
        return $menu;
    }
}
