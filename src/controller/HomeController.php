<?php

namespace SK\Controller;


class HomeController extends Controller {


    public function __construct()
    {
        parent::__construct();

    }

    public function home()
    {
        echo $this->twig->render('home.html.twig');
    }
}