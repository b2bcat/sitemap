<?php

namespace B2bcat\SiteMap\Validation;

abstract class Validator
{
    /**
     * @var mixed
     */
    protected mixed $data;

    /**
     * @return void
     */
    abstract public function validate(): void;

    /**
     * @param mixed $data
     */
    public function __construct (mixed $data)
    {
        $this->data = $data;
        $this->validate();
    }

    /**
     * @return mixed
     */
    public function getData (): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData (mixed $data): void
    {
        $this->data = $data;
    }
}
