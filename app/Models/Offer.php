<?php

namespace App\Models;



class Offer 
{
    private $categoryName;
    private $title;
    private $description;
    private $startEvent;
    private $idCategory;
    private Address $address;

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     */
    public function setCategoryName($categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStartEvent()
    {
        return $this->startEvent;
    }

    /**
     * @param mixed $startEvent
     */
    public function setStartEvent($startEvent): void
    {
        $this->startEvent = $startEvent;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function getAddressFullString()
    {
        return $this->address->getAddressFullName();
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param mixed $idCategory
     */
    public function setIdCategory($idCategory): void
    {
        $this->idCategory = $idCategory;
    }


    public function separateClass($separator)
    {
        return $this->categoryName.$separator.
            $this->title.$separator.
            $this->description.$separator.
            $this->startEvent.$separator.
            $this->idCategory.$separator.
            $this->address->separateClass($separator);
    }
}