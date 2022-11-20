<?php

namespace B2bcat\SiteMap\Storage;

class PathHelper
{
    /**
     * @param $path
     * @return string|null
     */
    public static function getFirstWritableParentDir ($path): string|null
    {
        $wrap = fn($path) => '/' . $path;
        $dir = dirname($path);
        $existedDir = null;

        if (!is_dir($dir)) {
            $splitPath = mb_split('/', $dir);
            $splitPath = array_slice($splitPath, 1, count($splitPath));

            $rootDir = $wrap($splitPath[0]);
            $depth = count($splitPath);

            for ($i = 0; $i < $depth; ++$i) {
                $currentSplitPath = $splitPath;
                $parentPath = $wrap(
                    implode('/',
                        array_splice(
                            $currentSplitPath,
                            0,
                            $depth - $i
                        )
                    )
                );
                if (is_dir($parentPath)) {
                    $existedDir = $parentPath;
                    break;
                }
            }
            if ((is_null($existedDir) && !is_writable($rootDir))) {
                return null;
            }
        } else {
            $existedDir = $dir;
        }

        if (!is_writable($existedDir)) {
            return null;
        }

        return $existedDir;
    }

}
