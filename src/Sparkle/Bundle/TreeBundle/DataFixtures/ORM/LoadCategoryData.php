<?php

    namespace Sparkle\Bundle\TreeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sparkle\Bundle\TreeBundle\Entity\Category;
use Sparkle\Bundle\TreeBundle\Entity\Position;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCategoryData implements FixtureInterface
{

    protected $positionName = array(
        'position 1',
        'position 2',
        'position 3',
        'position 4',
        'position 5',
        'position 6',
        'position 7',
        'position 8',
        'position 9',
    );
    protected $positionType = array(
        1,2,3,2,2,1,1,3,1
    );
    protected $positionParent = array(
        1,1,1,4,4,4,5,5,5
    );
    protected $categoryName = array(
        'category 1',
        'category 2',
        'category 3',
        'category 4',
        'category 5',
        'category 6',
    );
    protected $categoryParent = array(
        null,
        0,
        null,
        2,
        3,
        null,
    );
    protected $category;

    public function load(ObjectManager $manager)
    {
        $this->loadCategory($manager);
        $this->loadPositions($manager);
    }

    private function loadPositions(ObjectManager $manager)
    {

        foreach ($this->positionName as $k => $v) {
            $Position = new Position();
            $Position->setPositionName($v);
            $Position->setTypeId($this->positionType[$k]);
            $Position->setCategory($this->category[$this->positionParent[$k]]);
            $manager->persist($Position);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadCategory(ObjectManager $manager)
    {
        foreach ($this->categoryName as $k => $v) {
            $category = new Category();
            $category->setCategoryName($v);
            $category->setSortOrder($k);

            $manager->persist($category);
        }
        $manager->flush();
        $entities = $manager->getRepository('SparkleTreeBundle:Category')->findAll();
        foreach ($entities as $entity) {
            $this->category[$entity->getSortOrder()] = $entity;
        }
        foreach ($this->categoryParent as $k => $v) {
            if ($v!==null) {
                /** @var Category $entity */
                $entity = $this->category[$k];
                $entity->setParent($this->category[$v]);
                $manager->merge($entity);
            }
        }
        $manager->flush();
    }
}
