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
        1,2,3,4,5,6,7,8,9
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
        1,
        null,
        3,
        4,
        null,
    );

    public function load(ObjectManager $manager)
    {
        $this->loadCategory($manager);
        $this->loadPositions($manager);
    }

    private function loadPositions(ObjectManager $manager)
    {

        foreach( $this->positionName as $k=>$v){
            $Position = new Position();
            $Position->setPositionName($v);
            $Position->setTypeId($this->positionType[$k]);
            $Position->setCategoryId($this->positionParent[$k]);
            $manager->persist($Position);
        }

        $manager->flush();
    }

    private function loadCategory(ObjectManager $manager)
    {
        foreach( $this->categoryName as $k=>$v){
            $category = new Category();
            $category->setCategoryName($v);
            $category->setSortOrder($k);

            $manager->persist($category);
        }
        $manager->flush();
    }

}