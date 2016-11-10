<?php

namespace LibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;
use LibraryBundle\Entity\Book;

class BookRepository extends EntityRepository
{
    /**
     * @return Book[]|array
     */
    public function findAllSubscribed()
    {
        $queryBuilder = $this->createQueryBuilder('book');
        $queryBuilder
            ->where($queryBuilder->expr()->isNotNull('book.user'))
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
