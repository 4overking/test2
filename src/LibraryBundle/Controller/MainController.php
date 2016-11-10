<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Model\LibrarySerializableInterface;
use LibraryBundle\Service\SubscriptionsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function getBooksAction()
    {
        $subscribedBooks = $this->getSubscriptionsService()->getSubscribedBooks();

        return new JsonResponse($this->buildArrayFromModels($subscribedBooks));
    }

    public function getUsersAction()
    {
        $subscribers = $this->getSubscriptionsService()->getSubscribers();

        return new JsonResponse($this->buildArrayFromModels($subscribers));
    }

    /**
     * @return SubscriptionsService
     */
    private function getSubscriptionsService()
    {
        return $this->container->get('library.subscriptions');
    }

    /**
     * @param LibrarySerializableInterface[]|array $models
     *
     * @return array
     */
    private function buildArrayFromModels(array $models)
    {
        $arr = [];
        foreach ($models as $model) {
            $arr[] = $model->serialize();
        }

        return $arr;
    }
}
