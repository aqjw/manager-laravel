<?php

namespace Aqjw\ManagerLaravel\Library\Models;

use Carbon\Carbon;
use File;

/**
 *
 */
class Models
{

    public function getListModels()
    {
        function getModels($path, $recursive = true, $prefix = '')
        {
            $out = [];

            if ($recursive) {
                $files = File::allFiles($path);
            } else {
                $files = File::files($path);
            }

            foreach ($files as $file) {
                $filename = $file->getFilename();
                if (false !== strpos($filename, '.php')) {
                    $filename = explode('/', $filename);
                    $out[] = [
                        'name' => $prefix . str_replace('.php', '', end($filename)),
                        'size' => $file->getSize(),
                        'updated_at' => Carbon::createFromTimestamp($file->getMTime()),
                    ];
                }
            }

            return $out;
        }

        $path = app_path();
        $models = getModels($path, false, 'App.');
        $path = app_path('Models');
        if (is_dir($path)) {
            $models = array_merge($models,
                getModels($path, true, 'App.Models.')
            );
        }

        return collect($models);
    }
}
