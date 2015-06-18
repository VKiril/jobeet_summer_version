<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 17.06.2015
 * Time: 14:59
 */

namespace Ibw\BlogBundle\Handler;


use Doctrine\Common\Persistence\ObjectManager;

class PageHandler //implements PageHandlerInterface
{
    public $om ;
    public $entityClass;
    public $repository;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }
}