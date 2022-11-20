<?php

namespace B2bcat\SiteMap\Laravel\Generator\Traits;

use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\Generator\DynamicRoute;

trait HasPriority {

    /**
     * @var float|null
     */
    protected float|null $priority = null;

    /**
     * @param float $priority
     * @return HasPriority|DynamicRoute|StaticRoute
     */
    public function setPriority (float $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriority (): float|null
    {
        return $this->priority;
    }
}
