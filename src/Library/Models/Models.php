<?php

namespace Aqjw\ManagerLaravel\Library\Models;

use Carbon\Carbon;
use File;
use ReflectionClass;

/**
 *
 */
class Models
{

    public function getListModels()
    {
        function getModels($path, $inModals = true)
        {
            if (!is_dir($path)) {
                return [];
            }

            if ($inModals) {
                $files = File::allFiles($path);
                $prefix = 'App.Models.';
            } else {
                $files = File::files($path);
                $prefix = 'App.';
            }

            $models = [];
            foreach ($files as $file) {
                $filename = $file->getFilename();
                if (false !== strpos($filename, '.php')) {
                    $filename = explode('/', $filename);
                    $namespace = $prefix . str_replace('.php', '', end($filename));

                    if (!(new ReflectionClass(str_replace('.', '\\', $namespace)))->isInstantiable()) {
                        // Cannot create an instance of this class.
                        continue;
                    }

                    $models[] = [
                        'name' => $namespace,
                        'size' => $file->getSize(),
                        'updated_at' => Carbon::createFromTimestamp($file->getMTime()),
                    ];
                }
            }

            return $models;
        }

        $models = array_merge(
            getModels(app_path(), false),
            getModels(app_path('Models'))
        );

        return collect($models);
    }
}
