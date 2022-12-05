<?php

namespace App\Models;



class Address 
{
    private $country;
    private $city;
    private $street;
    private $zipCode;

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getAddressFullName(): string{
        return 'ul. '.$this->getStreet().', '.$this->getZipCode().' '.$this->getCity().' '.$this->getCountry();
    }


    public function separateClass($separator)
    {
        return $this->country.$separator.
            $this->city.$separator.
            $this->street.$separator.
            $this->zipCode.$separator;
    }
}
