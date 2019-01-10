<?php

namespace Aqjw\ManagerLaravel\Library\Models;

use Aqjw\ManagerLaravel\Library\Helper;

/**
 *
 */
class Model
{
    use Helper;

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

    protected function getModelMethods($model, $regex_filter_except)
    {
        $methods = array_diff(
            get_class_methods($model),
            $this->baseMethods
        );

        $methods = array_filter($methods, function ($method) use ($regex_filter_except) {
            return !preg_match($regex_filter_except, $method);
        });

        return $methods;
    }

    protected function buildModel($namespace)
    {
        $filename = str_replace(['.', 'App/'], ['/', ''], $namespace);
        $namespace = $this->getNamespace($namespace);

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

    private function exceptionModelNotFound($name)
    {
        //
        throw new \Exception("Model [{$name}] not found", 404);
    }
}
