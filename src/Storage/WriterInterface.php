<?php

namespace B2bcat\SiteMap\Storage;

interface WriterInterface
{
    /**
     * @param mixed $data
     * @return WriterInterface
     */
    public function setData(array $data): WriterInterface;

    /**
     * @param string $filePath
     * @return WriterInterface
     */
    public function setFilePath(string $filePath): WriterInterface;

    /**
     * @return void
     */
    public function write(): void;

}