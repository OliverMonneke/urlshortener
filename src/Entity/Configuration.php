<?php

namespace Codersquad\Urlshortener\Entity;

use Codersquad\Urlshortener\DepencyInjection\YamlConfigLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Class Configuration.
 */
class Configuration
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $codelength;

    /**
     * @var string
     */
    private $allowedchars;

    /**
     *
     */
    public function __construct()
    {
        $directories = array(__DIR__.'/../Resources/config');
        $locator = new FileLocator($directories);
        $loader = new YamlConfigLoader($locator);
        $configValues = $loader->load($locator->locate('config.yml'));

        foreach ($configValues['codersquad']['urlshortener'] as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getCodelength()
    {
        return $this->codelength;
    }

    /**
     * @return mixed
     */
    public function getAllowedchars()
    {
        return $this->allowedchars;
    }
}
