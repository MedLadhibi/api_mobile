<?php

namespace ActionBundle\Repository;

use Doctrine\ORM\NonUniqueResultException;

/**
 * ActionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActionRepository extends \Doctrine\ORM\EntityRepository
{


    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return object or null
     */
    public function findActionByid($id)
    {
        try {
            return $this->getEntityManager()
                ->createQuery(
                    "SELECT p
                FROM ActionBundle:Action
                p WHERE p.id =:id"
                )
                ->setParameter('id', $id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM ActionBundle:Action p
                WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function findOneById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, u.username
       FROM ActionBundle:Post
       a JOIN a.user u
        WHERE a.id = id"
            )
            ->setParameter('id', $id)
            ->getArrayResult();
    }
    /**
     * get all actions
     *
     * @return array
     */
    public function findAllActions()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
         FROM ActionBundle:Action a
      
         ORDER BY a.posted_at DESC'
            )
            ->getArrayResult();
    }


}

