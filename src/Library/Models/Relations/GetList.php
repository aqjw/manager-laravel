<?php

namespace Aqjw\ManagerLaravel\Library\Models\Relations;

use ReflectionClass;

/**
 *
 */
class GetList
{
    private $baseMethods = [
        '__construct', 'clearBootedModels', 'withoutTouching', 'withoutTouchingOn', 'isIgnoringTouch', 'fill',
        'forceFill', 'qualifyColumn', 'newInstance', 'newFromBuilder', 'on', 'onWriteConnection', 'all', 'with',
        'load', 'loadMissing', 'update', 'push', 'save', 'saveOrFail', 'destroy', 'delete', 'forceDelete', 'query',
        'newQuery', 'newModelQuery', 'newQueryWithoutRelationships', 'registerGlobalScopes', 'newQueryWithoutScopes',
        'newQueryWithoutScope', 'newQueryForRestoration', 'newEloquentBuilder', 'newCollection', 'newPivot', 'toArray',
        'toJson', 'jsonSerialize', 'fresh', 'refresh', 'replicate', 'is', 'isNot', 'getConnection', 'getConnectionName',
        'setConnection', 'resolveConnection', 'getConnectionResolver', 'setConnectionResolver', 'unsetConnectionResolver',
        'getTable', 'setTable', 'getKeyName', 'setKeyName', 'getQualifiedKeyName', 'getKeyType', 'setKeyType', 'getIncrementing',
        'setIncrementing', 'getKey', 'getQueueableId', 'getQueueableRelations', 'getQueueableConnection', 'getRouteKey',
        'getRouteKeyName', 'resolveRouteBinding', 'getForeignKey', 'getPerPage', 'setPerPage', '__get', '__set', 'offsetExists',
        'offsetGet', 'offsetSet', 'offsetUnset', '__isset', '__unset', '__call', '__callStatic', '__toString', '__wakeup',
        'attributesToArray', 'relationsToArray', 'getAttribute', 'getAttributeValue', 'getRelationValue', 'hasGetMutator',
        'setAttribute', 'hasSetMutator', 'fillJsonAttribute', 'fromJson', 'fromFloat', 'fromDateTime', 'getDates', 'getDateFormat',
        'setDateFormat', 'hasCast', 'getCasts', 'getAttributes', 'setRawAttributes', 'getOriginal', 'only', 'syncOriginal',
        'syncOriginalAttribute', 'syncOriginalAttributes', 'syncChanges', 'isDirty', 'isClean', 'wasChanged', 'getDirty', 'getChanges',
        'append', 'setAppends', 'getMutatedAttributes', 'cacheMutatedAttributes', 'observe', 'getObservableEvents', 'setObservableEvents',
        'addObservableEvents', 'removeObservableEvents', 'retrieved', 'saving', 'saved', 'updating', 'updated', 'creating', 'created',
        'deleting', 'deleted', 'flushEventListeners', 'getEventDispatcher', 'setEventDispatcher', 'unsetEventDispatcher', 'addGlobalScope',
        'hasGlobalScope', 'getGlobalScope', 'getGlobalScopes', 'hasOne', 'morphOne', 'belongsTo', 'morphTo', 'getActualClassNameForMorph',
        'hasMany', 'hasManyThrough', 'morphMany', 'belongsToMany', 'morphToMany', 'morphedByMany', 'joiningTable', 'joiningTableSegment',
        'touches', 'touchOwners', 'getMorphClass', 'getRelations', 'getRelation', 'relationLoaded', 'setRelation', 'unsetRelation', 'setRelations',
        'getTouchedRelations', 'setTouchedRelations', 'touch', 'setCreatedAt', 'setUpdatedAt', 'freshTimestamp', 'freshTimestampString',
        'usesTimestamps', 'getCreatedAtColumn', 'getUpdatedAtColumn', 'getHidden', 'setHidden', 'addHidden', 'getVisible', 'setVisible',
        'addVisible', 'makeVisible', 'makeHidden', 'getFillable', 'fillable', 'getGuarded', 'guard', 'unguard', 'reguard', 'isUnguarded',
        'unguarded', 'isFillable', 'isGuarded', 'totallyGuarded', 'getAuthIdentifierName', 'getAuthIdentifier', 'getAuthPassword', 'getRememberToken',
        'setRememberToken', 'getRememberTokenName', 'can', 'cant', 'cannot', 'getEmailForPasswordReset', 'sendPasswordResetNotification',
        'hasVerifiedEmail', 'markEmailAsVerified', 'sendEmailVerificationNotification', 'notifications', 'readNotifications', 'unreadNotifications',
        'notify', 'notifyNow', 'routeNotificationFor',
    ];

    private $relationsName = [
        'HasOne', 'HasMany', 'BelongsTo',
        'BelongsToMany', 'MorphMany', 'HasManyThrough',
        'MorphToMany', 'MorphTo',
    ];

    public function getList($namespace)
    {
        $model = $this->buildModel($namespace);
        $methods = $this->getModelMethods($model);

        $relations = [];
        foreach ($methods as $method) {
            try {
                if (!$this->methodHasOptionalParameters($model, $method) ||
                    !method_exists($model, $method) || !is_object($model->{$method}())
                ) {
                    continue;
                }
            } catch (\Exception $e) {
                continue;
            }

            $relationType = explode('\\', get_class($model->{$method}()));
            if (in_array(end($relationType), $this->relationsName)) {
                $relations[] = [
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

        return collect($relations)->groupBy('relationType');
    }

    private function getModelMethods($model)
    {
        $methods = array_diff(
            get_class_methods($model),
            $this->baseMethods
        );

        $methods = array_filter($methods, function ($method) {
            return !preg_match("/^(get|set|scope|attribute)/", $method);
        });

        return $methods;
    }

    private function buildModel($namespace)
    {
        $filename = str_replace(['.', 'App/'], ['/', ''], $namespace);
        $namespace = str_replace('.', '\\', $namespace);

        if (!file_exists(app_path($filename) . '.php')) {
            $this->exceptionModelNotFound($namespace);
        }
        try {
            $model = app($namespace);
        } catch (\Exception $e) {
            $this->exceptionModelNotFound($namespace);
        }

        return $model;
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

    private function getMehodArguments($instance, $method)
    {
        $reflector = new ReflectionClass($instance);
        $arguments = [];
        foreach ($reflector->getMethod($method)->getParameters() as $key => $parameter) {
            $arguments[$key]['name'] = $parameter->getName();
            if ($parameter->isOptional()) {
                $arguments[$key]['default'] = $parameter->getDefaultValue();
            }
        }

        return $arguments;
    }

    private function methodHasOptionalParameters($instance, $method)
    {
        $reflector = new ReflectionClass($instance);
        foreach ($reflector->getMethod($method)->getParameters() as $parameter) {
            if (!$parameter->isOptional()) {
                return false;
            }
        }

        return true;
    }

    private function exceptionModelNotFound($name)
    {
        //
        throw new \Exception("Model [{$name}] not found", 404);
    }
}
