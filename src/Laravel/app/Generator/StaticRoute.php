<?php

namespace B2bcat\SiteMap\Laravel\Generator;

use B2bcat\SiteMap\SiteMap;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasLastmod;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasPriority;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasRouteName;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasChangefreq;

class StaticRoute implements SiteMapDataProvider
{

    use HasRouteName;
    use HasChangefreq;
    use HasPriority;
    use HasLastmod;

    /**
     * @return array
     */
    public function getData(): array
    {
        $item = [
            SiteMap::ATTR_LOC => route($this->getRouteName())
        ];

        if ($this->getLastmod()) {
            $item[SiteMap::ATTR_LAST_MOD] = $this->getLastmod();
        }

        if ($this->getPriority()) {
            $item[SiteMap::ATTR_PRIORITY] = $this->getPriority();
        }

        if ($this->getChangefreq()) {
            $item[SiteMap::ATTR_CHANGE_FREC] = $this->getChangefreq();
        }

        return [
            $item
        ];
    }
}
