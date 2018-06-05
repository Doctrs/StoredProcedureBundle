<?php

namespace Doctrs\StoredProcedureBundle\Utils;

interface ProcedureInterface
{
    /**
     * @param string            $connection
     * @param \PgFunc\Procedure $procedure
     *
     * @return mixed
     */
    public function execute(string $connection, \PgFunc\Procedure $procedure);

    /**
     * @param string $key
     * @param array  $connectionData
     *
     * @return ProcedureInterface
     */
    public function setConfiguration(string $key, array $connectionData): ProcedureInterface;
}
