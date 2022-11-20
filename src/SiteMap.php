<?php

namespace B2bcat\SiteMap;

use B2bcat\SiteMap\Exceptions\InvalidDataException;
use B2bcat\SiteMap\Exceptions\InvalidFilePathException;
use B2bcat\SiteMap\Exceptions\InvalidFileTypeException;
use B2bcat\SiteMap\Storage\File;
use B2bcat\SiteMap\Storage\WriterFactory;
use B2bcat\SiteMap\Validation\DataValidator;
use B2bcat\SiteMap\Validation\FileTypeValidator;
use B2bcat\SiteMap\Validation\PathValidator;

class SiteMap
{
    public const ATTR_LOC = 'loc';

    public const ATTR_LAST_MOD = 'lastmod';

    public const ATTR_PRIORITY = 'priority';

    public const ATTR_CHANGE_FREC = 'changefreq';

    public const ATTR_CHANGE_FREC_VALUES = [
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly'
    ];

    public const FILE_TYPES = [
        File::TYPE_JSON,
        File::TYPE_CSV,
        File::TYPE_XML
    ];


    /**
     * @param array $pages
     * @param string $fileType
     * @param string $path
     */
    public function __construct (array $pages, string $fileType, string $path)
    {
        new DataValidator($pages);
        new FileTypeValidator($fileType);
        new PathValidator($path);

        (new WriterFactory($fileType))
            ->getWriter()
            ->setData($pages)
            ->setFilePath($path)
            ->write();
    }


}
