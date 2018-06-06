<?php

namespace Doctrs\StoredProcedureBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ChangeConnectionNameEvent extends Event
{
    /**
     * @var string
     */
    private $name;

    /**
     * ChangeConnectionNameEvent constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

}
