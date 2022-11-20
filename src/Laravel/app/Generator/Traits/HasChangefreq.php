<?php

namespace B2bcat\SiteMap\Laravel\Generator\Traits;

use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\Generator\DynamicRoute;

trait HasChangefreq {

    /**
     * @var string|null
     */
    protected string|null $changefreq = null;

    /**
     * @param string $changefreq
     * @return HasChangefreq|DynamicRoute|StaticRoute
     */
    public function setChangefreq (string $changefreq): self
    {
        $this->changefreq = $changefreq;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChangefreq (): string|null
    {
        return $this->changefreq;
    }
}
