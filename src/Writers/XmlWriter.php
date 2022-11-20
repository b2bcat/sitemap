<?php

namespace B2bcat\SiteMap\Writers;

use B2bcat\SiteMap\Storage\Writer;
use B2bcat\SiteMap\Storage\WriterInterface;

class XmlWriter extends Writer implements WriterInterface
{
    /**
     * @return array
     */
    protected function getPreparedData (): array
    {
        return $this->getData();
    }

    /**
     * @return Writer
     */
    protected function writeFile (): Writer
    {
        $xml = new \XMLWriter();
        $data = $this->getPreparedData();

        $xml->openUri($this->getFilePath());
        $xml->startDocument('1.0', 'UTF-8');
        $xml->setIndent(true);
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");
        $xml->writeAttribute('xsi:schemaLocation', "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
        $xml->writeAttribute('xmlns', "http://www.sitemaps.org/schemas/sitemap/0.9");

        foreach ($data as $row) {
            $xml->startElement('url');
            foreach ($row as $key => $value) {
                $xml->writeElement($key, $value);
            }
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();

        return $this;
    }
}
