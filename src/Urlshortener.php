<?php

namespace Codersquad\Urlshortener;

/**
 * Class Urlshortener.
 */
final class Urlshortener
{
    /**
     * Server URL starting with protocol and ending with a slash.
     *
     * @var string
     */
    private $server = 'http://codersquad.de/';

    /**
     * Allowed chars for short code.
     *
     * @var string
     */
    private $allowedChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Length of code.
     *
     * @var int
     */
    private $codeLength = 12;

    /**
     * The short code.
     *
     * @var string
     */
    private $code = null;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     *
     * @return $this
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowedChars()
    {
        return $this->allowedChars;
    }

    /**
     * @param mixed $allowedChars
     *
     * @return $this
     */
    public function setAllowedChars($allowedChars)
    {
        $this->allowedChars = $allowedChars;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->getServer().$this->getCode();
    }

    /**
     * @return string
     */
    public function generateCode()
    {
        $stringLength = strlen($this->getAllowedChars());
        $code = '';

        for ($i = 1; $i <= $this->getCodeLength(); $i++) {
            $randomNumber = rand(0, ($stringLength-1));
            $code .= substr($this->getAllowedChars(), $randomNumber, 1);
        }

        $this->setCode($code);

        return $this->getCode();
    }

    /**
     * @return int
     */
    public function getCodeLength()
    {
        return $this->codeLength;
    }

    /**
     * @param int $codeLength
     */
    public function setCodeLength($codeLength)
    {
        $this->codeLength = $codeLength;
    }
}
