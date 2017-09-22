<?php

namespace SK\Controller;


class HomeController extends Controller {

    public $fetcher;

    public function home()
    {
        var_dump($this->fetcher); die;
        echo "all good";
    }
}