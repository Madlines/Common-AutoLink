<?php

namespace Madines\Common\Tests;

use Madlines\Common\AutoLink\AutoLink;

class AutoLinkTest extends \PHPUnit_Framework_TestCase
{
    public function urlsReplacementDataProvider()
    {
        return [
            ['www.google.pl', '<a href="http://www.google.pl" target="_blank">www.google.pl</a>'],
            [' http://www.google.pl', ' <a href="http://www.google.pl" target="_blank">www.google.pl</a>'],
            ['http://www.google.pl', '<a href="http://www.google.pl" target="_blank">www.google.pl</a>'],
            ['ftp://www.google.pl', '<a href="ftp://www.google.pl" target="_blank">ftp://www.google.pl</a>'],
            ['ftps://www.google.pl', '<a href="ftps://www.google.pl" target="_blank">ftps://www.google.pl</a>'],
            ['https://www.google.pl', '<a href="https://www.google.pl" target="_blank">www.google.pl</a>'],
            [
                'https://www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet',
                '<a href="https://www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet" target="_blank">www.example.com:8803/foo/bar?lorem=ipsum#dolor/sit/amet</a>'
            ],
            [
                'Lorem ipsum at ftp://www.google.pl' . "\r\n" . 'at dolor sit https://example.com ipsum',
                'Lorem ipsum at <a href="ftp://www.google.pl" target="_blank">ftp://www.google.pl</a>' . "\r\n" . 'at dolor sit <a href="https://example.com" target="_blank">example.com</a> ipsum',
            ],
            [
                'Lorem ipsum at www.google.pl' . " " . 'at dolor sit https://example.com ipsum',
                'Lorem ipsum at <a href="http://www.google.pl" target="_blank">www.google.pl</a>' . " " . 'at dolor sit <a href="https://example.com" target="_blank">example.com</a> ipsum',
            ],
        ];
    }

    /**
     ** @dataProvider urlsReplacementDataProvider
     */
    public function testAutolink($input, $output)
    {
        $this->assertEquals($output, AutoLink::parse($input));
    }
}
