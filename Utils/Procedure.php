<?php

namespace Doctrs\StoredProcedureBundle\Utils;

<<<<<<< HEAD
use Doctrine\Common\Collections\ArrayCollection;
use Doctrs\StoredProcedureBundle\Event\ChangeConnectionEvent;
use Doctrs\StoredProcedureBundle\Event\ChangeConnectionNameEvent;
use Doctrs\StoredProcedureBundle\Event\ChangeResultEvent;
use Doctrs\StoredProcedureBundle\Event\StoredProcedureEvents;
use PgFunc\Configuration;
use PgFunc\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\BadMethodCallException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\EventDispatcher\EventDispatcher;
=======
use PgFunc\Configuration;
use PgFunc\Connection;
use Symfony\Component\DependencyInjection\Exception\BadMethodCallException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167

class Procedure implements ProcedureInterface
{
    /**
     * @var ArrayCollection
     */
    private $configurations;

    /**
     * @var ArrayCollection
     */
    private $connections;

<<<<<<< HEAD
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * Procedure constructor.
     *
     * @param EventDispatcher $dispatcher
     */
    public function __construct(ContainerInterface $container)
    {
        $this->dispatcher = $container->get('event_dispatcher');
=======
    public function __construct()
    {
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
        $this->configurations = new ArrayCollection();
        $this->connections = new ArrayCollection();
    }

    /**
     * @param string            $connection
     * @param \PgFunc\Procedure $procedure
     *
     * @return mixed
     *
     * @throws \PgFunc\Exception
     * @throws ParameterNotFoundException
     */
<<<<<<< HEAD
    public function execute($connection, \PgFunc\Procedure $procedure)
    {
        $event = new ChangeConnectionNameEvent($connection);
        $this->dispatcher->dispatch(StoredProcedureEvents::CONNECTION_NAME, $event);

        $connection = $event->getName();

=======
    public function execute(string $connection, \PgFunc\Procedure $procedure)
    {
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
        if (!$this->configurations->get($connection)) {
            throw new ParameterNotFoundException(
                sprintf('Configuration "%s" not found in configuration pool', $connection)
            );
        }

        if (!$this->connections->get($connection)) {
            $this->connections->set($connection, new Connection($this->configurations->get($connection)));
        }

        /** @var Connection $connection */
        $connection = $this->connections->get($connection);

<<<<<<< HEAD
        // Connection event
        $event = new ChangeConnectionEvent($connection, $procedure);
        $this->dispatcher->dispatch(StoredProcedureEvents::CONNECTION, $event);

        $connection = $event->getConnection();
        $procedure = $event->getProcedure();

        $result = $connection->queryProcedure($procedure);

        // Result Event
        $event = new ChangeResultEvent($result);
        $this->dispatcher->dispatch(StoredProcedureEvents::RESULT, $event);

        return $event->getResult();
=======
        return $connection->queryProcedure($procedure);
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
    }

    /**
     * @param string $key
     * @param array  $connectionData
     *
     * @return ProcedureInterface
     *
     * @throws BadMethodCallException
     */
<<<<<<< HEAD
    public function setConfiguration($key, array $connectionData): ProcedureInterface
=======
    public function setConfiguration(string $key, array $connectionData): ProcedureInterface
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
    {
        $configuration = new \PgFunc\Configuration();

        foreach ($connectionData as $method => $value) {
            $method = 'set'.str_replace('_', '', ucwords($method, '_'));

            if (!method_exists($configuration, $method)) {
                throw new BadMethodCallException(
                    sprintf('Method "%s" not found in class "%s"', $method, get_class($configuration))
                );
            }

            $configuration->$method($value);
        }

        $this->configurations->set($key, $configuration);

        return $this;
    }

    /**
<<<<<<< HEAD
     * @param Configuration $configuration
=======
     * @param Configuration|string $configuration
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
     *
     * @return Procedure
     */
    public function removeConfiguration($configuration): ProcedureInterface
    {
        if ($configuration instanceof Configuration) {
            $this->configurations->removeElement($configuration);
        } else {
            $this->configurations->remove($configuration);
        }

        return $this;
    }

    /**
     * @param Connection $connection
     *
     * @return Procedure
     */
<<<<<<< HEAD
    public function setConnection($key, Connection $connection): ProcedureInterface
=======
    public function setConnection(string $key, Connection $connection): ProcedureInterface
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
    {
        $this->connections->set($key, $connection);

        return $this;
    }

    /**
<<<<<<< HEAD
     * @param Connection $connection
=======
     * @param Connection|string $connection
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
     *
     * @return Procedure
     */
    public function removeConnection($connection): ProcedureInterface
    {
        if ($connection instanceof Connection) {
            $this->connections->removeElement($connection);
        } else {
            $this->connections->remove($connection);
        }

        return $this;
    }
}
