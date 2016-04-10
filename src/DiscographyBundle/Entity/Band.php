<?php

namespace DiscographyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Band
 *
 * @ORM\Table(name="band")
 * @ORM\Entity(repositoryClass="DiscographyBundle\Repository\BandRepository")
 */
class Band
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Musician")
     * @ORM\JoinTable(name="band_musicians",
     *     joinColumns={@ORM\JoinColumn(name="band_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="musician_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $members;

    /**
     * Band constructor.
     */
    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Band
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /**
     * @param Musician $musician
     */
    public function addMember(Musician $musician)
    {
        $this->members->add($musician);
    }

    /**
     * Remove member
     *
     * @param Musician $member
     */
    public function removeMember(Musician $member)
    {
        $this->members->removeElement($member);
    }
}
