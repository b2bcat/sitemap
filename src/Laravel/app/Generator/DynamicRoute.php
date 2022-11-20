<?php

namespace B2bcat\SiteMap\Laravel\Generator;

use Carbon\Carbon;
use B2bcat\SiteMap\SiteMap;
use Illuminate\Database\Eloquent\Builder;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasPriority;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasRouteName;
use B2bcat\SiteMap\Laravel\Generator\Traits\HasChangefreq;

class DynamicRoute implements SiteMapDataProvider
{
    use HasRouteName;
    use HasChangefreq;
    use HasPriority;

    /**
     * @var Builder
     */
    protected Builder $queryBuilder;

    /**
     * @var string|null
     */
    protected string|null $lastmodField = null;


    /**
     * @param Builder $queryBuilder
     * @return DynamicRoute
     */
    public function setQueryBuilder (Builder $queryBuilder): self
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder (): Builder
    {
        return $this->queryBuilder;
    }


    /**
     * @param string $field_name
     * @return DynamicRoute
     */
    public function setLastmodField (string $field_name = 'updated_at'): DynamicRoute
    {
        $this->lastmodField = $field_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastmodField (): string|null
    {
        return $this->lastmodField;
    }

    /**
     * @return array
     */
    public function getData (): array
    {
        $models = $this->getQueryBuilder()->get();

        $routeName = $this->getRouteName();
        $data = [];

        foreach ($models as $model) {
            $item = [
                SiteMap::ATTR_LOC => route($routeName, $model)
            ];

            if ($this->getLastmodField()) {
                $value = $model->{$this->getLastmodField()};
                if ($value instanceof Carbon) {
                    $item[SiteMap::ATTR_LAST_MOD] = $model->{$this->getLastmodField()}->toDateTimeString();
                }
            }

            if ($this->getPriority()) {
                $item[SiteMap::ATTR_PRIORITY] = $this->getPriority();
            }

            if ($this->getChangefreq()) {
                $item[SiteMap::ATTR_CHANGE_FREC] = $this->getChangefreq();
            }

            $data[] = $item;
        }

        return $data;
    }

}
