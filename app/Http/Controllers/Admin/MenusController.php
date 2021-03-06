<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Category;
use Corp\Http\Requests\MenusRequest;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Lavary\Menu\Facade as Menu;

class MenusController extends AdminController
{
    public function __construct(Request $request, MenusRepository $mrep, ArticlesRepository $arep, PortfoliosRepository $prep)
    {
        parent::__construct();

        $this->m_rep = $mrep;
        $this->a_rep = $arep;
        $this->p_rep = $prep;

        $this->template = env('THEME').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setUser();
        if(Gate::denies('VIEW_ADMIN_MENU')) {
            abort(403);
        }

        $menu = $this->getUsersMenus();
        $this->content = view(env('THEME') . '.admin.menus_content')->with('menus', $menu)->render();

        return $this->renderOutput();
    }

    protected function getUsersMenus()
    {
        $menu = $this->m_rep->get();
        if($menu->isEmpty()){
            return false;
        }
        return Menu::make('forMenuPart', function($m) use ($menu) {
            foreach ($menu as $item) {
                if ($item->parent == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if ($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Добавить новый пункт';
        $menu = $this->getUsersMenus()->roots();

        $resultMenu = $menu->reduce(function($returnMenus, $item){
            $returnMenus[$item->id] = $item->title;
            return $returnMenus;
        }, ['0'=>'Родительский элемент']);

        $categories = \Corp\Category::select(['title','alias','parent_id','id'])->get();
        $listCat['0'] = 'Не используется';
        $listCat['parent'] = 'Раздел блог';
        foreach ($categories as $category)
        {
            if($category->parent_id ==0){
                $listCat[$category->title] = [];
            }
            else{
                $rootCategory = $categories->where('id',$category->parent_id)->first()->title;
                $listCat[$rootCategory][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id','title','alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);

        $filters = \Corp\Filter::select('id','title','alias')->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел портфолио']);

        $portfolios = $this->p_rep->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME').'.admin.menus_create_content')->with(['menus'=>$resultMenu,'categories'=>$listCat,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $result = $this->m_rep->addMenu($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
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
    public function edit(\Corp\Menu $punkt_menu)
    {
        $this->title = 'Редактирование пункта ' . $punkt_menu->title;

        $type = false;
        $option = false;

        $route = app('router')->getRoutes()->match(app('request')->create($punkt_menu->path));
        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        if($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat') {
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        }
        else if($aliasRoute == 'articles.show') {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';

        }
        else if($aliasRoute == 'portfolios.index') {
            $type = 'portfolioLink';
            $option = 'parent';

        }
        else if($aliasRoute == 'portfolios.show') {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';

        }
        else {
            $type = 'customLink';
        }

        $menu = $this->getUsersMenus()->roots();

        $resultMenu = $menu->reduce(function($returnMenus, $item){
            $returnMenus[$item->id] = $item->title;
            return $returnMenus;
        }, ['0'=>'Родительский элемент']);

        $categories = \Corp\Category::select(['title','alias','parent_id','id'])->get();
        $listCat['0'] = 'Не используется';
        $listCat['parent'] = 'Раздел блог';
        foreach ($categories as $category)
        {
            if($category->parent_id ==0){
                $listCat[$category->title] = [];
            }
            else{
                $rootCategory = $categories->where('id',$category->parent_id)->first()->title;
                $listCat[$rootCategory][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id','title','alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);

        $filters = \Corp\Filter::select('id','title','alias')->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел портфолио']);

        $portfolios = $this->p_rep->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME').'.admin.menus_create_content')->with(['menu'=>$punkt_menu, 'type'=>$type, 'option'=>$option ,'menus'=>$resultMenu,'categories'=>$listCat,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Corp\Menu $punkt_menu)
    {
        $result = $this->m_rep->updateMenu($request, $punkt_menu);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $punkt_menu)
    {
        $result = $this->m_rep->deleteMenu($punkt_menu);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }
}
