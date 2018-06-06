<?php

namespace Doctrs\StoredProcedureBundle\Utils;

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
    public function execute($connection, \PgFunc\Procedure $procedure)
    {
        $event = new ChangeConnectionNameEvent($connection);
        $this->dispatcher->dispatch(StoredProcedureEvents::CONNECTION_NAME, $event);

        $connection = $event->getName();

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
    }

    /**
     * @param string $key
     * @param array  $connectionData
     *
     * @return ProcedureInterface
     *
     * @throws BadMethodCallException
     */
    public function setConfiguration($key, array $connectionData): ProcedureInterface
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
     * @param Configuration $configuration
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
    public function setConnection($key, Connection $connection): ProcedureInterface
    {
        $this->connections->set($key, $connection);

        return $this;
    }

    /**
     * @param Connection $connection
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
