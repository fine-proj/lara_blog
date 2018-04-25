<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\ArticlesRepository;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends AdminController
{
    public function __construct(Request $request, ArticlesRepository $arep)
    {
        parent::__construct();
        $this->a_rep = $arep;
        $this->template = env('THEME').'.admin.articles';
    }

    private function checkPermissions(){
        if(Gate::denies('VIEW_ADMIN_ARTICLES')) {
            abort(403);
        }
    }

    protected function getArticles()
    {
        return $this->a_rep->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setUser();
        $this->checkPermissions();

        $this->title = 'Менеджер статей';

        $articles = $this->getArticles();
        $this->content = view(env('THEME') . '.admin.articles_content')->with('articles', $articles)->render();

        return $this->renderOutput();
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
