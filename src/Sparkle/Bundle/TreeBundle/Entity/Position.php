<?php

namespace Sparkle\Bundle\TreeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sparkle\Bundle\TreeBundle\Entity\PositionRepository")
 */
class Position
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_id", type="integer")
     */
    private $typeId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="positions")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="Cascade")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="position_name", type="string", length=255)
     */
    private $positionName;


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
     * Set typeId
     *
     * @param integer $typeId
     * @return Position
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }


    /**
     * Set positionName
     *
     * @param string $positionName
     * @return Position
     */
    public function setPositionName($positionName)
    {
        $this->positionName = $positionName;

        return $this;
    }

    /**
     * Get positionName
     *
     * @return string 
     */
    public function getPositionName()
    {
        return $this->positionName;
    }

    /**
     * Set category
     *
     * @param \Sparkle\Bundle\TreeBundle\Entity\Category $category
     * @return Position
     */
    public function setCategory(\Sparkle\Bundle\TreeBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Sparkle\Bundle\TreeBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
