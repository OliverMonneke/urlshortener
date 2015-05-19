<?php

namespace Codersquad\Urlshortener\Tests\UrlshortenerTest;

use Codersquad\Urlshortener\Urlshortener;

/**
 * Class UrlshortenerTest.
 */
class UrlshortenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Urlshortener
     */
    private $shortener = null;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->shortener = new Urlshortener();
    }

    /**
     *
     */
    public function testGetUrl()
    {
        $this->shortener->setCode('test123');
        $this->shortener->setServer('http://test.codersquad.de/');

        $this->assertEquals('http://test.codersquad.de/test123', $this->shortener->getUrl());
    }

    /**
     *
     */
    public function testSetCodeLength()
    {
        $this->shortener->setCodeLength(13);

        $this->assertEquals(13, $this->shortener->getCodeLength());
    }

    /**
     *
     */
    public function testSetAllowedChars()
    {
        $this->shortener->setAllowedChars('asdf');

        $this->assertEquals('asdf', $this->shortener->getAllowedChars());
    }

    /**
     *
     */
    public function testGenerateCode()
    {
        $code = $this->shortener->generateCode();

        $this->assertEquals($code, $this->shortener->getCode());
        $this->assertEquals($this->shortener->getCodeLength(), strlen($code));
    }
}
