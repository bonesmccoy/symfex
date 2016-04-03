<?php


namespace Bones\UserBundle\Entity;


class UserTotal
{

    private $total;
    private $roles;

    /**
     * UserTotal constructor.
     * @param $total
     * @param $roles
     */
    private function __construct($total, $roles)
    {

        $this->total = $total;
        $this->roles = $roles;
    }

    public static function factory($array)
    {
        return new UserTotal($array['total'], $array['roles']);
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    
}