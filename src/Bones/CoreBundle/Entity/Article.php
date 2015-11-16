<?php

namespace Bones\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonesArticle
 *
 * @ORM\Table(name="bones_article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_columns", type="text", length=65535, nullable=true)
     */
    private $metaColumns;



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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set metaColumns
     *
     * @param string $metaColumns
     *
     * @return Article
     */
    public function setMetaColumns($metaColumns)
    {
        $this->metaColumns = $metaColumns;

        return $this;
    }

    /**
     * Get metaColumns
     *
     * @return string
     */
    public function getMetaColumns()
    {
        return $this->metaColumns;
    }
}
