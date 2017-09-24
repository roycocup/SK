<?php
namespace SK\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity(repositoryClass="DataPointRepository")
 * @Table( indexes={ @Index(columns={"timestamp"}) }, name="datapoint")
 **/
class DataPoint
{

    static public $types = [
        'download'=>'DOWNLOAD',
        'upload' => 'UPLOAD',
        'latency' => 'LATENCY',
        'packet_loss' => 'PACKET_LOSS'
    ];

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="integer")
     */
    protected $unit;

    /**
     * @Column(type="string")
     */
    protected $type;

    /**
     * @Column(type="datetime")
     */
    protected $timestamp;

    /**
     * @Column(type="integer")
     */
    protected $value;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set unit
     *
     * @param integer $unit
     *
     * @return DataPoint
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return integer
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return DataPoint
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return DataPoint
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return DataPoint
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

}