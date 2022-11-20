<?php

use B2bcat\SiteMap\SiteMap;

beforeEach(function () {
    $this->data = [
        [
            SiteMap::ATTR_LOC => 'http://ya.ru',
            SiteMap::ATTR_LAST_MOD => '2020-02-02 02:02:02',
            SiteMap::ATTR_CHANGE_FREC => 'daily',
            SiteMap::ATTR_PRIORITY => 0.1
        ]
    ];
});

afterEach(function () {
    array_map( 'unlink', array_filter((array) glob($this->tmp . "*") ) );
});


test('can write xml', function () {
    $path = $this->tmp . 'a.xml';
    new SiteMap(
       $this->data,
       'xml',
       $path
   );
   $xml = XMLReader::open($path);
   $xml->setParserProperty(XMLReader::VALIDATE, true);
   $this->assertTrue($xml->isValid());
});

test('can write json', function () {
    $path = $this->tmp . 'b.json';
    new SiteMap(
        $this->data,
        'json',
        $path
    );
    $data = json_decode(file_get_contents($path), true);
    $this->assertEquals($data, $this->data);
});

test('can write csv', function () {
    $path = $this->tmp . 'c.csv';
    new SiteMap(
        $this->data,
        'csv',
        $path
    );
    $this->assertEquals(
        str_getcsv(file($path)[1]),
        array_values($this->data[0])
    );
});

