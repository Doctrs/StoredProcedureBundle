<?php

namespace Doctrs\StoredProcedureBundle\DependencyInjection;

use Doctrs\StoredProcedureBundle\Utils\Procedure;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
<<<<<<< HEAD
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;
=======
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class StoredProcedureExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        if (!isset($configs[0]['connections'])) {
            throw new InvalidConfigurationException('Section "stored_procedure" must be configured');
        }

        $procedureDefinition = new Definition(Procedure::class);
        $procedureDefinition->setPublic(true);
        $procedureDefinition->setAutoconfigured(true);
<<<<<<< HEAD
        $procedureDefinition->setArguments([
            new Reference('service_container')
        ]);
=======
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167

        foreach ($configs[0]['connections'] as $name => $data) {
            $procedureDefinition->addMethodCall('setConfiguration', [
                $name,
                $data,
            ]);
        }

        $container->setDefinition('doctrs.stored_procedure', $procedureDefinition);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
