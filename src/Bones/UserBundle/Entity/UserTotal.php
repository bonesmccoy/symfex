<?php

namespace Bones\UserBundle\Entity;

/**
 * Class UserTotal
 */
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

    /**
     * @param array $data
     *
     * @return UserTotal
     */
    public static function factory($data)
    {
        return new UserTotal($data['total'], $data['roles']);
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
