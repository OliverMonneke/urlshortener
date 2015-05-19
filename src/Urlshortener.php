<?php

namespace Codersquad\Urlshortener;

use Codersquad\Urlshortener\Entity\Configuration;
use Codersquad\Urlshortener\Entity\UrlshortenerRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;

/**
 * Class Urlshortener.
 */
class Urlshortener
{
    /**
     * The short code.
     *
     * @var string
     */
    private $code;

    /**
     * URL to redirect
     *
     * @var string
     */
    private $url;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->configuration = new Configuration();
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
     * @return string
     */
    public function generateCode()
    {
        $stringLength = strlen($this->getConfiguration()->getAllowedChars());
        $code = '';

        for ($i = 1; $i <= $this->getConfiguration()->getCodelength(); $i++) {
            $randomNumber = rand(0, ($stringLength - 1));
            $code .= substr($this->getConfiguration()->getAllowedchars(), $randomNumber, 1);
        }

        $this->setCode($code);

        while ($this->codeExists()) {
            $this->generateCode();
        }

        return $this->getCode();
    }

    /**
     * @return Configuration
     */
    private function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return bool
     */
    public function codeExists()
    {
        $repository = new UrlshortenerRepository($this->entityManager, $this->entityManager->getClassMetadata(get_class(new \Codersquad\Urlshortener\Entity\Urlshortener())));
        $entity = $repository->findOneBy(['code' => $this->getCode()]);

        return ($entity !== null);
    }

    /**
     * @return bool
     */
    public function add()
    {
        if ($this->codeExists()) {
            return false;
        }

        $entity = new Entity\Urlshortener();
        $entity->setCode($this->getCode());
        $entity->setUrl($this->getUrl());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return true;
    }

    /**
     * @return bool
     */
    public function remove()
    {
        if ($this->codeExists()){
            $repository = new UrlshortenerRepository($this->entityManager, $this->entityManager->getClassMetadata(get_class(new \Codersquad\Urlshortener\Entity\Urlshortener())));
            $entity = $repository->findOneBy(['code' => $this->getCode()]);
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->getUrl().'/'.$this->getCode();
    }
}
