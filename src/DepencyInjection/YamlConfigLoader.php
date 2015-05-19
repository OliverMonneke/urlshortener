<?php

namespace Codersquad\Urlshortener\DepencyInjection;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigLoader.
 */
class YamlConfigLoader extends FileLoader
{
    /**
     * @param mixed $resource
     * @param null  $type
     *
     * @return mixed
     */
    public function load($resource, $type = null)
    {
        $configValues = Yaml::parse($resource);

        return $configValues;
    }

    /**
     * @param mixed $resource
     * @param null  $type
     *
     * @return bool
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}
