<?php
/**
 * Created by PhpStorm.
 * User: Gabin Challe
 * Date: 28/02/2018
 * Time: 10:00
 */

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Tag;

class TagRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function update(Tag $tag){
        $this->_em->persist($tag);
        $this->_em->flush();
    }
}