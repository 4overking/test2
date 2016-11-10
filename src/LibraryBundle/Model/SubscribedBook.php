<?php

namespace LibraryBundle\Model;

class SubscribedBook implements LibrarySerializableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $userUid;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int   $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param  string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserUid(): string
    {
        return $this->userUid;
    }

    /**
     * @param  string $userUid
     * @return $this
     */
    public function setUserUid(string $userUid)
    {
        $this->userUid = $userUid;

        return $this;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'id'      => $this->getId(),
            'title'   => $this->getTitle(),
            'userUid' => $this->getUserUid(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public static function unserialize(array $data)
    {
        $subscribedBook = new static();
        if (isset($data['id'])) {
            $subscribedBook->setId($data['id']);
        }
        if (isset($data['title'])) {
            $subscribedBook->setTitle($data['title']);
        }
        if (isset($data['userUid'])) {
            $subscribedBook->setUserUid($data['userUid']);
        }

        return $subscribedBook;
    }
}
