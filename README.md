# Stored Procedure Bundle

Symfony bundle for pgfunc lib

[![Build Status](https://scrutinizer-ci.com/g/Doctrs/StoredProcedureBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Doctrs/StoredProcedureBundle/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Doctrs/StoredProcedureBundle/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2461d171-1aae-4aac-8887-9c68b358bce7/mini.png)](https://insight.sensiolabs.com/projects/2461d171-1aae-4aac-8887-9c68b358bce7)

Bundle for work with stored procedure through [https://github.com/red-defender/pgfunc](https://github.com/red-defender/pgfunc)

You may create many connection and execute stored procedure throught one of them

# Install

```
composer require doctrs/stored-procedure-bundle
```

# Configuration

Create file `config/packages/stored_procedure.yaml` and configure connections

```
stored_procedure:
    connections:
        api_master:
            dbname: '%env(API_DB_MASTER_DBNAME)%'
            host: '%env(API_DB_MASTER_HOST)%'
            port: '%env(API_DB_MASTER_PORT)%'
            user: '%env(API_DB_MASTER_USER)%'
        admin_master:
            dbname: '%env(ADMIN_DB_MASTER_DBNAME)%'
            host: '%env(ADMIN_DB_MASTER_HOST)%'
            port: '%env(ADMIN_DB_MASTER_PORT)%'
            user: '%env(ADMIN_DB_MASTER_USER)%'
        any_connection: ~
        any_second_connection: ~
```

List of all configure variables
```
application_name
client_encoding
connect_timeout
dbname
fallback_application_name
gsslib
host
hostaddr
keepalives
keepalives_count
keepalives_idle
keepalives_interval
krbsrvname
options
passfile
port
requirepeer
requiressl
service
sslcert
sslcompression
sslcrl
sslkey
sslmode
sslrootcert
target_session_attrs
tty
```

# Execute procedure

```php
Procedure::execute(string $connectionName, \PgFunc\Procedure $procedure);

...

$procedure = new Procedure('any_procedure_name');
$procedure->addParameters(...$parameters);
...
return $container->get('doctrs.stored_procedure')->execute('api_master', $procedure);
```

# Events

* **stored_procedure.connection_name** - Change connection name.
* **stored_procedure.connection** - Change connection class, and change Procedure class
* **stored_procedure.result** - Change result
