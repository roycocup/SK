<?php

namespace SK\Controller;


use SK\Entity\DataPoint;

class HomeController extends Controller {


    public function __construct()
    {
        parent::__construct();

    }

    public function home()
    {
        $repo = $this->em->getRepository('SK\Entity\DataPoint');
        $data = [];

        if(!empty($_POST) && $_POST['selectedDate'])
        {
            $selectedDate = $_POST['selectedDate'];

            $dt = new \DateTime();
            $dt->setTimestamp((int) $selectedDate);
            $data['curDate'] = $dt;
            $data['calculatedValues'] = $repo->getCalculatedValues($dt);
        }

        //get all dates with data by hour
        $data['dates'] = $repo->getAllDates();

        echo $this->twig->render('home.html.twig', $data);
    }
}