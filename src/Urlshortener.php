<?php

namespace Codersquad\Urlshortener;

use Doctrine\Common\Persistence\Mapping\Driver\DefaultFileLocator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

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
     * @var array
     */
    private $configuration = [];

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param array                       $configuration
     */
    public function __construct(EntityManager $entityManager, array $configuration = [])
    {
        $this->configuration = $configuration;

        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new DefaultFileLocator(__DIR__));
        $loader->load(__DIR__.'/../services.yml');

        try {
            $configuration = Yaml::parse(file_get_contents(__DIR__.'/../config.yml'));
            var_dump($configuration['doctrine']['dbal']);
            exit;
        } catch (ParseException $e) {
            printf('Unable to parse the YAML string: %s', $e->getMessage());
        }
//        $entityManager = EntityManager::create($dbParams, $config);
    }

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
            $randomNumber = rand(0, ($stringLength - 1));
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
