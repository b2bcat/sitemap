<?php

namespace B2bcat\SiteMap\Laravel\Generator\Traits;

use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\SiteMapGenerator\Traits\DynamicRoute;

trait HasLastmod {

    /**
     * @var string|null
     */
    protected string|null $lastmod = null;

    /**
     * @param string $field_name
     * @return HasLastmod|StaticRoute
     */
    public function setLastmod (string $field_name = 'updated_at'): self
    {
        $this->lastmod = $field_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastmod (): string|null
    {
        return $this->lastmod;
    }
}
