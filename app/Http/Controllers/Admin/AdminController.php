<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Facade as Menu;
use Illuminate\Support\Facades\Gate;

class AdminController extends \Corp\Http\Controllers\Controller
{
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    protected $vars;

    protected $user;

    protected $template;

    protected $title;

    protected $content = false;

    public function __construct()
    {
        /*$this->user = Auth::user();
        if(!$this->user){
            abort(403);
        }*/
    }

    //использовать в каждом экшкне всех дочерних контроллеров
    // вместо работы родительского конструктора
    public function setUser(){
        $this->user = Auth::user();
        if(!$this->user){
            abort(403);
        }
    }

    public function renderOutput(){
        $this->vars['title'] = $this->title;

        $menu = $this->getMenu();
        $navigation = view(config('settings.theme').'.admin.navigation')->with('menu',$menu)->render();
        $this->vars['navigation'] = $navigation;

        if($this->content) {
            $this->vars['content'] = $this->content;
        }

        $footer = view(env('THEME') . '.admin.footer')->render();
        $this->vars['footer'] = $footer;

        return view($this->template, $this->vars);//->with($this->vars);
    }

    protected function getMenu(){
        return Menu::make('adminMenu', function($m){
            if(Gate::allows('VIEW_ADMIN_ARTICLES')) {
                $m->add('Статьи', ['route' => 'admin.articles.index']);
            }

            $m->add('Портфолио', ['route'  => 'admin.articles.index']);
            $m->add('Меню',  ['route'  => 'admin.menus.index']);
            $m->add('Пользователи',  ['route'  => 'admin.users.index']);
            $m->add('Привилегии',  ['route'  => 'admin.permissions.index']);
        });
    }
}
