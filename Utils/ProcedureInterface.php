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
<<<<<<< HEAD
    public function execute($connection, \PgFunc\Procedure $procedure);
=======
    public function execute(string $connection, \PgFunc\Procedure $procedure);
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167

    /**
     * @param string $key
     * @param array  $connectionData
     *
     * @return ProcedureInterface
     */
<<<<<<< HEAD
    public function setConfiguration($key, array $connectionData): ProcedureInterface;
=======
    public function setConfiguration(string $key, array $connectionData): ProcedureInterface;
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
}
