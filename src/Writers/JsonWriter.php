<?php

namespace B2bcat\SiteMap\Writers;

use B2bcat\SiteMap\Storage\Writer;
use B2bcat\SiteMap\Storage\WriterInterface;

class JsonWriter extends Writer implements WriterInterface
{
    protected function getPreparedData (): string
    {
       return json_encode($this->getData());
    }
}
