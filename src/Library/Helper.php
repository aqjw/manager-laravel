<?php

namespace Aqjw\ManagerLaravel\Library;

use ReflectionClass;

/**
 *
 */
trait Helper
{
    protected function getMehodArguments($instance, $method): array
    {
        $arguments = [];

        $reflector = new ReflectionClass($instance);
        $parameters = $reflector->getMethod($method)->getParameters();

        foreach ($parameters as $key => $parameter) {
            $arguments[$key]['name'] = $parameter->getName();
            if ($parameter->isOptional()) {
                $arguments[$key]['default'] = $parameter->getDefaultValue();
            }
        }

        return $arguments;
    }

    protected function isInstantiable($namespace): bool
    {
        return (new ReflectionClass($namespace))->isInstantiable();
    }

    protected function getFileName($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    protected function getNamespace($namespace)
    {
        return str_replace('.', '\\', $namespace);
    }

    protected function getFilePath($namespace)
    {
        $reflector = new ReflectionClass($namespace);
        return $reflector->getFileName();
    }
}
