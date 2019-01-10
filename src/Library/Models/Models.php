<?php

namespace Aqjw\ManagerLaravel\Library\Models;

use Aqjw\ManagerLaravel\Library\Models\Model;
use Carbon\Carbon;
use File;

/**
 *
 */
class Models extends Model
{
    public function getListModels()
    {
        return array_merge(
            $this->getModels(app_path(), false),
            $this->getModels(app_path('Models'))
        );
    }

    private function getModels($path, $inModals = true)
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
            if ('php' == $file->getExtension()) {
                $namespace = $prefix . $this->getFileName($file->getFilename());

                if (!$this->isInstantiable($this->getNamespace($namespace))) {
                    // Cannot create an instance of this class.
                    continue;
                }

                $models[] = [
                    'name' => $namespace,
                    'namespace' => $this->getNamespace($namespace),
                    'size' => $file->getSize(),
                    'updated_at' => Carbon::createFromTimestamp($file->getMTime()),
                ];
            }
        }

        return $models;
    }
}
