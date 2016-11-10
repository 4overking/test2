<?php

namespace LibraryBundle\Model;

class Subscriber implements LibrarySerializableInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $uid;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param  string $surname
     * @return $this
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param  string $uid
     * @return $this
     */
    public function setUid(string $uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'uid'     => $this->getUid(),
            'name'    => $this->getName(),
            'surname' => $this->getSurname(),
        ];
    }
    /**
     * @param array $data
     *
     * @return $this
     */
    public static function unserialize(array $data)
    {
        $subscriber = new static();
        if (isset($data['uid'])) {
            $subscriber->setUid($data['uid']);
        }
        if (isset($data['name'])) {
            $subscriber->setName($data['name']);
        }
        if (isset($data['surname'])) {
            $subscriber->setSurname($data['surname']);
        }

        return $subscriber;
    }
}
