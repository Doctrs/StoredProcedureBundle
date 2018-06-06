<?php

namespace Doctrs\StoredProcedureBundle\Event;

use PgFunc\Connection;
use Symfony\Component\EventDispatcher\Event;

class ChangeResultEvent extends Event
{
    /**
     * @var mixed
     */
    private $result;

    /**
     * ChangeConnectionNameEvent constructor.
     *
     * @param mixed $connection
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }
}
