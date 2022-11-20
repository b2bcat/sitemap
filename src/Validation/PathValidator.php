<?php

namespace B2bcat\SiteMap\Validation;

use B2bcat\SiteMap\Exceptions\InvalidFilePathException;
use B2bcat\SiteMap\Storage\PathHelper;

class PathValidator extends Validator
{
    /**
     * @throws InvalidFilePathException
     */
    public function validate (): void
    {
        $path = $this->getData();
        if (!is_string($path)) {
            throw new InvalidFilePathException('Path should be string.');
        }
        if (is_null(PathHelper::getFirstWritableParentDir($path))) {
            throw new InvalidFilePathException('Not writable.');
        }
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
