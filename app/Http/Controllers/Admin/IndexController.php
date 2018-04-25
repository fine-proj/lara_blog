<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IndexController extends AdminController
{
    public function __construct(Request $request)
    {
        parent::__construct();
        /*данный код вынесен в метод checkPermissions()
         * if(Gate::denies('VIEW_ADMIN')){
                abort(403);
        }*/

        $this->template = env('THEME').'.admin.index';
    }

    private function checkPermissions(){
        if(Gate::denies('VIEW_ADMIN')) {
            abort(403);
        }
    }

    public function index(){
        $this->setUser();
        $this->checkPermissions();

        $this->title = 'Панель админа';
        return $this->renderOutput();
    }
}
