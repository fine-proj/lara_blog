<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends AdminController
{
    protected $per_rep;
    protected $rol_rep;

    public function __construct(PermissionsRepository $perrep, RolesRepository $rolrep)
    {
        parent::__construct();

        $this->per_rep = $perrep;
        $this->rol_rep = $rolrep;

        $this->template = env('THEME').'.admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setUser();
        if(Gate::denies('EDIT_USERS')) {
            abort(403);
        }

        $this->title = 'Менеджер прав';

        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content = view(env('THEME') . '.admin.permissions_content')
            ->with(['roles'=>$roles , 'priv'=>$permissions])->render();

        return $this->renderOutput();
    }

    protected function getRoles(){
        $roles = $this->rol_rep->get();
        return $roles;
    }
    protected function getPermissions(){
        $permissions = $this->per_rep->get();
        return $permissions;
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
        $result = $this->per_rep->changePermissions($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }

        return back()->with($result);
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
