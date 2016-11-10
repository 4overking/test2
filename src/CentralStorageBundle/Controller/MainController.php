<?php

namespace CentralStorageBundle\Controller;

use CentralStorageBundle\Entity\Library;
use CentralStorageBundle\Repository\LibraryRepository;
use Doctrine\ORM\EntityManager;
use Goutte\Client;
use LibraryBundle\Model\SubscribedBook;
use LibraryBundle\Model\Subscriber;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class MainController extends Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @return JsonResponse
     */
    public function getAllAction()
    {
        $subscribers = $this->getSubscribers();
        $subscribedBooks = $this->getSubscribedBooks();

        return new JsonResponse($this->buildAllSubscriptions($subscribers, $subscribedBooks));
    }

    /**
     * @param string $uid
     *
     * @return JsonResponse
     */
    public function getAction($uid)
    {
        $subscribedBooks = $this->getSubscribedBooks();

        return new JsonResponse($this->buildSingleSubscription($subscribedBooks, $uid));
    }

    /**
     * @param string $uid
     *
     * @return HttpResponse
     */
    public function getReportFooAction($uid)
    {
        // TODO implement report foo generation

        return new HttpResponse();
    }

    /**
     * @return array
     */
    protected function getSubscribers()
    {
        $subscribers = [];
        $libraries = $this->getLibraryRepository()->findAll();
        foreach ($libraries as $library) {
            $subscribers = array_merge($this->loadModelsFromLibraryAndUrl($library, 'library/user'), $subscribers);
        }

        return $subscribers;
    }

    /**
     * @return array
     */
    protected function getSubscribedBooks()
    {
        $subscribedBooks = [];
        $libraries = $this->getLibraryRepository()->findAll();
        foreach ($libraries as $library) {
            $subscribedBooks = array_merge($this->loadModelsFromLibraryAndUrl($library, 'library/book'), $subscribedBooks);
        }

        return $subscribedBooks;
    }

    /**
     * @return LibraryRepository
     */
    protected function getLibraryRepository()
    {
        return $this->getEntityManager()->getRepository('CentralStorageBundle:Library');
    }
    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }

    /**
     * @return Logger
     */
    protected function getLogger()
    {
        return $this->container->get('logger');
    }

    protected function loadModelsFromLibraryAndUrl(Library $library, $url)
    {
        $client = new Client();
        $client->request('GET', sprintf('%s/%s', $library->getHost(), $url));
        /** @var Response $response */
        $response = $client->getResponse();
        $contentType = $response->getHeader('Content-Type');
        $subscribers = [];
        if ($response->getStatus() === HttpResponse::HTTP_OK && null !== $contentType && $contentType === 'application/json') {
            $contentData = json_decode($response->getContent());
            foreach ($contentData as $subscriberData) {
                $subscribers[] = Subscriber::unserialize($subscriberData);
            }
        } else {
            $this->getLogger()->warning('Server response with status code '.$response->getStatus(), $this);
        }

        return $subscribers;
    }

    /**
     * @param Subscriber[]|array     $subscribers
     * @param SubscribedBook[]|array $subscribedBooks
     *
     * @return array
     */
    protected function buildAllSubscriptions($subscribers, $subscribedBooks)
    {
        $subscriptions = [];
        foreach ($subscribers as $subscriber) {
            $subscription = $subscriber->serialize();
            $subscription['books'] = [];
            foreach ($subscribedBooks as $subscribedBook) {
                if ($subscribedBook->getUserUid() === $subscriber->getUid()) {
                    $subscription['books'][] = $subscribedBook->serialize();
                }
            }
        }

        return $subscriptions;
    }

    /**
     * @param array  $subscribedBooks
     * @param string $uid
     *
     * @return array
     */
    private function buildSingleSubscription(array $subscribedBooks, $uid)
    {
        $subscription = [];
        foreach ($subscribedBooks as $subscribedBook) {
            if ($subscribedBook->getUserUid() === $uid) {
                $subscription['books'][] = $subscribedBook->serialize();
            }
        }

        return $subscription;
    }
}
