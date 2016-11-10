<?php

namespace LibraryBundle\Service;

use Doctrine\ORM\EntityManager;
use LibraryBundle\Model\SubscribedBook;
use LibraryBundle\Model\Subscriber;
use LibraryBundle\Repository\BookRepository;
use LibraryBundle\Repository\UserRepository;

class SubscriptionsService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * SubscriptionsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return SubscribedBook[]|array
     */
    public function getSubscribedBooks()
    {
        $subscribedBooks = [];
        $books = $this->getBookRepository()->findAllSubscribed();
        foreach ($books as $book) {
            $subscribedBook = new SubscribedBook();
            $subscribedBook
                ->setId($book->getId())
                ->setTitle($book->getTitle())
                ->setUserUid($book->getUser()->getUid())
            ;
            $subscribedBooks[] = $subscribedBook;
        }

        return $subscribedBooks;
    }

    /**
     * @return Subscriber[]|array
     */
    public function getSubscribers()
    {
        $subscribers = [];
        $users = $this->getUserRepository()->findAllSubscribers();
        foreach ($users as $user) {
            $subscriber = new Subscriber();
            $subscriber
                ->setName($user->getName())
                ->setSurname($user->getSurname())
                ->setUid($user->getUid())
            ;
            $subscribers[] = $subscriber;
        }

        return $subscribers;
    }

    /**
     * @return BookRepository
     */
    protected function getBookRepository()
    {
        return $this->entityManager->getRepository('LibraryBundle:Book');
    }

    /**
     * @return UserRepository
     */
    protected function getUserRepository()
    {
        return $this->entityManager->getRepository('LibraryBundle:User');
    }
}
