<?php

namespace LibraryBundle\Model;

interface LibrarySerializableInterface
{
    /**
     * @return array
     */
    public function serialize();

    /**
     * @return object
     */
    public static function unserialize(array $data);
}
