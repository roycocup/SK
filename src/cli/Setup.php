<?php

namespace SK\Cli;

use SK\Entity\DataPoint;

class Setup extends Command
{
    public $em;
    public $rawData;
    public $fetcher;
    public $configmanager;
    public $cache;

    public static $cacheFilename = 'cacheData.txt';

    public function __construct($entityManager)
    {
        parent::__construct();
        $this->em = $entityManager;
    }

    public function getRawData()
    {
        $url = $this->configmanager->get('dataUrl');

        $cachedData = $this->cache->getCached(self::$cacheFilename);

        if($cachedData)
            $this->rawData = $cachedData;
        else{
            $this->rawData = $this->fetcher->getData($url);
            $this->cache->cache(self::$cacheFilename, $this->rawData);
        }

        return $this->rawData;
    }

    public function persistRawData()
    {
        $this->output("Clearing datapoint table");
        //$repo = $this->em->getRepository('SK\\Entity\\DataPoint');
        $this->em->createQuery('DELETE SK\Entity\DataPoint')->getResult();

        $units = json_decode($this->rawData);

        $this->output("Initiating process");

        foreach ($units as $unit)
        {
            $this->output("Processing Unit " . $unit->unit_id . " of " . count($units));

            foreach ($unit->metrics->download as $downPoint)
            {
                $dataPoint = new DataPoint();
                $dataPoint->setUnit($unit->unit_id);
                $dataPoint->setType(DataPoint::$types['download']);
                $dataPoint->setTimestamp(new \DateTime($downPoint->timestamp));
                $dataPoint->setValue($downPoint->value);
                $this->em->persist($dataPoint);
            }


            foreach ($unit->metrics->upload as $downPoint)
            {
                $dataPoint = new DataPoint();
                $dataPoint->setUnit($unit->unit_id);
                $dataPoint->setType(DataPoint::$types['upload']);
                $dataPoint->setTimestamp(new \DateTime($downPoint->timestamp));
                $dataPoint->setValue($downPoint->value);
                $this->em->persist($dataPoint);
            }

            foreach ($unit->metrics->upload as $downPoint)
            {
                $dataPoint = new DataPoint();
                $dataPoint->setUnit($unit->unit_id);
                $dataPoint->setType(DataPoint::$types['latency']);
                $dataPoint->setTimestamp(new \DateTime($downPoint->timestamp));
                $dataPoint->setValue($downPoint->value);
                $this->em->persist($dataPoint);
            }

            foreach ($unit->metrics->upload as $downPoint)
            {
                $dataPoint = new DataPoint();
                $dataPoint->setUnit($unit->unit_id);
                $dataPoint->setType(DataPoint::$types['packet_loss']);
                $dataPoint->setTimestamp(new \DateTime($downPoint->timestamp));
                $dataPoint->setValue($downPoint->value);
                $this->em->persist($dataPoint);
            }
            $this->em->flush();
            $this->em->clear();
        }
    }

    public function output($message)
    {
        ob_start();
        echo $message . "\n";
        ob_flush();
    }

    public function run()
    {
        $this->getRawData();
        $this->persistRawData();
    }


}