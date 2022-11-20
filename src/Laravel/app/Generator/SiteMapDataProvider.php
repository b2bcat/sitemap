<?php

namespace B2bcat\SiteMap\Laravel\Generator;

interface SiteMapDataProvider
{
    /**
     * @return array
     */
    public function getData(): array;
}