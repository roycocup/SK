<?php
namespace SK\Entity;

use Doctrine\ORM\EntityRepository;

class DataPointRepository extends EntityRepository
{

    public function getAllDates()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('d.timestamp')
            ->from('SK\Entity\DataPoint', 'd')
            ->groupBy('d.timestamp')
            ->orderBy('d.timestamp', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function getCalculatedValues($timeStamp)
    {
        $dt = new \DateTime();
        $dt->setTimestamp((int) $timeStamp);


        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('max(d.value) mx, min(d.value) mn, count(d.value) as ssize, avg(d.value) average')
            ->from('SK\Entity\DataPoint', 'd')
            ->where('d.timestamp = ?1')
            ->groupBy('d.timestamp')
            ->setParameters([1 => $dt])
        ;

        //$res = $this->findBy(['timestamp' => $dt], ['timestamp' => 'desc', 'unit' => 'desc']);


        $res = $qb->getQuery()->getResult();

        return $res;
    }


}