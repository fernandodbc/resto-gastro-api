<?php
namespace Fdbc\Resto\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Fdbc\Resto\CoreBundle\Repository\RestaurantRepository")
 */
class Restaurant
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $name;

    /**
     * @MongoDB\String
     */
    protected $longName;

    /**
     * @MongoDB\String
     */
    protected $address;

    /**
     * @MongoDB\String
     */
    protected $zipCode;

    /**
     * @MongoDB\String
     */
    protected $city;

    /**
     * @MongoDB\Date
     */
    protected $inspectionDate;

    /**
     * @MongoDB\Float
     */
    protected $lat;

    /**
     * @MongoDB\Float
     */
    protected $lon;

    /**
     * @MongoDB\Int
     */
    protected $score;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set longName
     *
     * @param string $longName
     * @return self
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;
        return $this;
    }

    /**
     * Get longName
     *
     * @return string $longName
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return self
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string $zipCode
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set inspectionDate
     *
     * @param date $inspectionDate
     * @return self
     */
    public function setInspectionDate($inspectionDate)
    {
        $this->inspectionDate = $inspectionDate;
        return $this;
    }

    /**
     * Get inspectionDate
     *
     * @return date $inspectionDate
     */
    public function getInspectionDate()
    {
        return $this->inspectionDate;
    }

    /**
     * Set lat
     *
     * @param int $lat
     * @return self
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * Get lat
     *
     * @return int $lat
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param int $lon
     * @return self
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
        return $this;
    }

    /**
     * Get lon
     *
     * @return int $lon
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set score
     *
     * @param int $score
     * @return self
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Get score
     *
     * @return int $score
     */
    public function getScore()
    {
        return $this->score;
    }
}
