<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\MenusRepository;
use Corp\Menu;
use Illuminate\Support\Facades\Mail;
class ContactsController extends SiteController
{
    public function __construct()
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->bar = 'left';
        $this->template = env('THEME')  .  '.contacts';
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            $messages = [
                'required' => 'Поле :attribute Обязательно к заполнению',
                'email'    => 'Поле :attribute должно содержать правильный email адрес',
            ];

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'message' => 'required' //text
            ]/*,$messages*/);

            $data = $request->all();


            $result = Mail::send(env('THEME').'.email', ['data' => $data], function ($m) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $m->from($data['email'], $data['name']);
                $m->to($mail_admin, 'Mr. Admin')->subject('Question');
            });

            if($result) {
                return redirect()->route('contacts')->with('status', 'Email is send');
            }
        }

        $this->title = "Контакты";
        $this->keywords = "Contacts";
        $this->meta_desc = "Contacts";

        //$content = view(env('THEME') . '.contact_content')->render();

        $content = view('pink.contact_content')->render();

        $this->vars['content'] = $content;


        //$this->contentLeftBar = view(env('THEME') . '.contact_bar')->render();
        $this->contentLeftBar = view(env('THEME') . '.contact_bar')->render();

        return $this->renderOutput();
    }
}
