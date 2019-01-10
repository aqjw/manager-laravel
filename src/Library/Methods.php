<?php

namespace Aqjw\ManagerLaravel\Library;

use Aqjw\ManagerLaravel\Library\Helper;
use ReflectionClass;

/**
 *
 */
class Methods
{
    use Helper;

    public function exportMethod($local_namespace, $method_name): array
    {
        $namespace = $this->getNamespace($local_namespace);
        if ($this->isInstantiable($namespace)) {
            // build reflaction class
            $instance = new ReflectionClass($namespace);
            $method = $instance->getMethod($method_name);

            // get extra info
            $docComment = $method->getDocComment();
            $method_position = $method->export($method->class, $method->name, true);
            $class = $method->class;

            // method in the parent class
            $extends = $method->class != $namespace;

            // get the line number where the method starts and ends
            preg_match('/(\d+) - (\d+)/', $method_position, $matches);

            if (3 == count($matches)) {
                $start = $matches[1];
                $end = $matches[2];

                // get code of method
                $methodCode = $this->readFileFromTo(
                    $method->getFileName(),
                    --$start, $end
                );

                return compact('class', 'docComment', 'methodCode', 'extends');
            }
        }

        return [
            'class' => null, 'docComment' => null,
            'methodCode' => null, 'extends' => null,
        ];
    }

    private function readFileFromTo($path, $start, $end)
    {
        $lines = array_slice(
            explode("\n", file_get_contents($path)),
            $start, $end - $start
        );

        return implode("\n", $lines);
    }
}
