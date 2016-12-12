<?php
/**
 * Created by PhpStorm.
 * User: city
 * Date: 2016/12/9
 * Time: 0:41
 */
class Info
{
    var $esradio1;
    var $esradio2;
    var $adradio1;
    var $adradio2;
    var $adname;
    var $age;
    var $gender;
    var $readtime;
    var $type;

    /**
     * Info constructor.
     * @param $esradio2
     * @param $adradio1
     * @param $adradio2
     * @param $adname
     * @param $age
     * @param $gender
     * @param $readtime
     * @param $type
     */
    public function __construct($esradio1,$esradio2, $adradio1, $adradio2, $adname, $age, $gender, $readtime, $type)
    {
        $this->esradio1 = $esradio1;
        $this->esradio2 = $esradio2;
        $this->adradio1 = $adradio1;
        $this->adradio2 = $adradio2;
        $this->adname = $adname;
        $this->age = $age;
        $this->gender = $gender;
        $this->readtime = $readtime;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEsradio1()
    {
        return $this->esradio1;
    }

    /**
     * @param mixed $esradio1
     */
    public function setEsradio1($esradio1)
    {
        $this->esradio1 = $esradio1;
    }

    /**
     * @return mixed
     */
    public function getEsradio2()
    {
        return $this->esradio2;
    }

    /**
     * @param mixed $esradio2
     */
    public function setEsradio2($esradio2)
    {
        $this->esradio2 = $esradio2;
    }

    /**
     * @return mixed
     */
    public function getAdradio1()
    {
        return $this->adradio1;
    }

    /**
     * @param mixed $adradio1
     */
    public function setAdradio1($adradio1)
    {
        $this->adradio1 = $adradio1;
    }

    /**
     * @return mixed
     */
    public function getAdradio2()
    {
        return $this->adradio2;
    }

    /**
     * @param mixed $adradio2
     */
    public function setAdradio2($adradio2)
    {
        $this->adradio2 = $adradio2;
    }

    /**
     * @return mixed
     */
    public function getAdname()
    {
        return $this->adname;
    }

    /**
     * @param mixed $adname
     */
    public function setAdname($adname)
    {
        $this->adname = $adname;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getReadtime()
    {
        return $this->readtime;
    }

    /**
     * @param mixed $readtime
     */
    public function setReadtime($readtime)
    {
        $this->readtime = $readtime;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
