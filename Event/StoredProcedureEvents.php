<?php

namespace Doctrs\StoredProcedureBundle\Event;

final class StoredProcedureEvents
{
    /**
     * Вызывается перед определнием имени соединения
     * Есть возможность переопределить имя соединения
     *
     * @Event("Doctrs\StoredProcedureBundle\Event\ChangeConnectionNameEvent")
     */
    public const CONNECTION_NAME = 'stored_procedure.connection_name';

    /**
     * Вызывается после получения соединения
     * Есть возможность переопределить соединения
     *
     * @Event("Doctrs\StoredProcedureBundle\Event\ChangeConnectionEvent")
     */
    public const CONNECTION = 'stored_procedure.connection';

    /**
     * Вызывается после получения соединения
     * Есть возможность переопределить соединения
     *
     * @Event("Doctrs\StoredProcedureBundle\Event\ChangeConnectionEvent")
     */
    public const RESULT = 'stored_procedure.result';
}
