<?php

namespace Model;

class Author
{
    private $id;
    private $first_name;
    private $last_name;
    private $date_birth;
    private $date_death;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateBirth()
    {
        return $this->date_birth;
    }

    /**
     * @param mixed $date_birth
     */
    public function setDateBirth($date_birth)
    {
        $this->date_birth = $date_birth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDeath()
    {
        return $this->date_death;
    }

    /**
     * @param mixed $date_death
     */
    public function setDateDeath($date_death)
    {
        $this->date_death = $date_death;
        return $this;
    }

}