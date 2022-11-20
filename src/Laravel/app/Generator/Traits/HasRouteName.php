<?php

namespace B2bcat\SiteMap\Laravel\Generator\Traits;

use B2bcat\SiteMap\Laravel\Generator\StaticRoute;
use B2bcat\SiteMap\Laravel\Generator\DynamicRoute;

trait HasRouteName {

    /**
     * @var string
     */
    protected string $routeName;

    /**
     * @param string $routeName
     * @return HasRouteName|DynamicRoute|StaticRoute
     */
    public function setRouteName (string $routeName): self
    {
        $this->routeName = $routeName;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouteName (): string
    {
        return $this->routeName;
    }
}
