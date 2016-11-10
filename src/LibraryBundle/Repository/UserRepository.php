<?php

namespace LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LibraryBundle\Entity\User;

class UserRepository extends EntityRepository
{
    /**
     * @return User[]|array
     */
    public function findAllSubscribers()
    {
        $queryBuilder = $this->createQueryBuilder('user');
        $queryBuilder
            ->join('user.books', 'book')
            ->where($queryBuilder->expr()->isNotNull('book.user'))
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
