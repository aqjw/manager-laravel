<?php

namespace Aqjw\ManagerLaravel\Library\Models\Relations;

use Aqjw\ManagerLaravel\Library\Models\Model;
use ReflectionClass;

/**
 *
 */
class GetList extends Model
{
    private $relationsName = [
        'HasOne', 'HasMany', 'BelongsTo',
        'BelongsToMany', 'MorphMany', 'HasManyThrough',
        'MorphToMany', 'MorphTo',
    ];

    public function getList($namespace)
    {
        $model = $this->buildModel($namespace);
        $methods = $this->getModelMethods($model,
            "/^(get|set|scope|attribute)/"
        );

        $relations = [];
        foreach ($methods as $method) {
            try {
                if (!method_exists($model, $method) ||
                    !$this->methodOptionalParameters($model, $method) ||
                    !is_object($model->{$method}())) {
                    continue;
                }
            } catch (\Exception $e) {
                continue;
            }

            $relationType = explode('\\', get_class($model->{$method}()));
            if (in_array(end($relationType), $this->relationsName)) {
                $relations[] = [
'exportMethod' => (new \Aqjw\ManagerLaravel\Library\Methods)->exportMethod($namespace, $method),
                    'relationType' => end($relationType),
                    'relationName' => $method,
                    'arguments' => $this->getMehodArguments($model, $method),
                    'parent' => $this->getPrivateVariable($model->{$method}(), 'parent', true),
                    'related' => $this->getPrivateVariable($model->{$method}(), 'related', true),
                    'throughParent' => $this->getPrivateVariable($model->{$method}(), 'throughParent', true),
                    'farParent' => $this->getPrivateVariable($model->{$method}(), 'farParent', true),
                    'firstKey' => $this->getPrivateVariable($model->{$method}(), 'firstKey'),
                    'secondKey' => $this->getPrivateVariable($model->{$method}(), 'secondKey'),
                    'morphType' => $this->getPrivateVariable($model->{$method}(), 'morphType'),
                    'morphClass' => $this->getPrivateVariable($model->{$method}(), 'morphClass'),
                    'localKey' => $this->getPrivateVariable($model->{$method}(), 'localKey'),
                    'secondLocalKey' => $this->getPrivateVariable($model->{$method}(), 'secondLocalKey'),
                    'foreignKey' => $this->getPrivateVariable($model->{$method}(), 'foreignKey'),
                    'ownerKey' => $this->getPrivateVariable($model->{$method}(), 'ownerKey'),
                    'foreignPivotKey' => $this->getPrivateVariable($model->{$method}(), 'foreignPivotKey'),
                    'relatedPivotKey' => $this->getPrivateVariable($model->{$method}(), 'relatedPivotKey'),
                    'parentKey' => $this->getPrivateVariable($model->{$method}(), 'parentKey'),
                    'relatedKey' => $this->getPrivateVariable($model->{$method}(), 'relatedKey'),
                ];
            }
        }
dd($relations);
        return collect($relations)->groupBy('relationType');
    }

    private function getPrivateVariable($instance, $variable, $class_name = false)
    {
        try {
            $reflection_class = new ReflectionClass($instance);
            if ($reflection_class->hasProperty($variable)) {
                $private_variable = $reflection_class->getProperty($variable);
                $private_variable->setAccessible(true);

                if ($class_name) {
                    return get_class($private_variable->getValue($instance));
                }
                return $private_variable->getValue($instance);
            }
            return null;
        } catch (\Exception $e) {
            // TODO
            throw $e;
        }
    }

    private function methodOptionalParameters($instance, $method): bool
    {
        $reflector = new ReflectionClass($instance);
        foreach ($reflector->getMethod($method)->getParameters() as $parameter) {
            if (!$parameter->isOptional()) {
                return false;
            }
        }

        return true;
    }
}
