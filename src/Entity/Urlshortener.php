<?php

namespace Codersquad\Urlshortener\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Urlshortener.
 *
 * @ORM\Table(name="urlshortener")
 * @ORM\Entity(repositoryClass="UrlshortenerRepository")
 */
class Urlshortener
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfRedirects", type="integer", nullable=false)
     */
    private $numberOfRedirects;

    /**
     *
     */
    public function __construct()
    {
        $this->numberOfRedirects = 0;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfRedirects()
    {
        return $this->numberOfRedirects;
    }

    /**
     * @param int $numberOfRedirects
     *
     * @return $this
     */
    public function setNumberOfRedirects($numberOfRedirects)
    {
        $this->numberOfRedirects = $numberOfRedirects;

        return $this;
    }
}
