<?php

namespace Doctrs\StoredProcedureBundle\Event;

use PgFunc\Connection;
use Symfony\Component\EventDispatcher\Event;

class ChangeConnectionEvent extends Event
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var \PgFunc\Procedure
     */
    private $procedure;

    /**
     * ChangeConnectionNameEvent constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection, \PgFunc\Procedure $procedure)
    {
        $this->connection = $connection;
        $this->procedure = $procedure;
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @param Connection $connection
     *
     * @return self
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * @return \PgFunc\Procedure
     */
    public function getProcedure(): \PgFunc\Procedure
    {
        return $this->procedure;
    }

    /**
     * @param \PgFunc\Procedure $procedure
     *
     * @return self
     */
    public function setProcedure(\PgFunc\Procedure $procedure)
    {
        $this->procedure = $procedure;

        return $this;
    }
}
