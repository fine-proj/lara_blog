<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

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

    public function __construct(){
    }

    public function renderOutput(){
        return view($this->template)->with($this->vars);
    }
}
