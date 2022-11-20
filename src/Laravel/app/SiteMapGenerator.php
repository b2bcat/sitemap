<?php

namespace B2bcat\SiteMap\Laravel;

use B2bcat\SiteMap\SiteMap;
use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\Generator\DynamicRoute;
use B2bcat\SiteMap\Exceptions\InvalidDataException;
use B2bcat\SiteMap\Exceptions\InvalidFilePathException;
use B2bcat\SiteMap\Exceptions\InvalidFileTypeException;
use B2bcat\SiteMap\Laravel\Generator\SiteMapDataProvider;

class SiteMapGenerator
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param DynamicRoute|StaticRoute|SiteMapDataProvider $route
     * @return $this
     */
    public function route (DynamicRoute|StaticRoute|SiteMapDataProvider $route): static
    {
        $this->data = array_merge($this->data, $route->getData());
        return $this;
    }

    /**
     * @throws InvalidDataException
     * @throws InvalidFileTypeException
     * @throws InvalidFilePathException
     */
    public function generate ($path): void
    {
        $fileType = array_reverse(mb_split('\.', $path))[0];

        new SiteMap($this->data, $fileType, $path);
    }

}
