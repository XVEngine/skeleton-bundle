<?php
namespace XVEngine\Bundle\SkeletonBundle\Generators;


class Bundle
{
    /**
     * @var string
     */
    private $packageName;
    /**
     * @var string
     */
    private $packageDescription;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $authorUrl;

    /**
     * @var string
     */
    private $authorEmail;

    /**
     * Get packageName value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * Set packageName value
     * @author Krzysztof Bednarczyk
     * @param string $packageName
     * @return  $this
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
        return $this;
    }

    /**
     * Get packageDescription value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getPackageDescription()
    {
        return $this->packageDescription;
    }

    /**
     * Set packageDescription value
     * @author Krzysztof Bednarczyk
     * @param string $packageDescription
     * @return  $this
     */
    public function setPackageDescription($packageDescription)
    {
        $this->packageDescription = $packageDescription;
        return $this;
    }

    /**
     * Get authorName value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set authorName value
     * @author Krzysztof Bednarczyk
     * @param string $authorName
     * @return  $this
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
     * Get authorUrl value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Set authorUrl value
     * @author Krzysztof Bednarczyk
     * @param string $authorUrl
     * @return  $this
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;
        return $this;
    }

    /**
     * Get authorEmail value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set authorEmail value
     * @author Krzysztof Bednarczyk
     * @param string $authorEmail
     * @return  $this
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
        return $this;
    }

    /**
     * Get namespace value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set namespace value
     * @author Krzysztof Bednarczyk
     * @param string $namespace
     * @return  $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }


    public function toComposerFormat()
    {
        return [
            "name" => $this->getPackageName() ?: "",
            "description" => $this->getPackageDescription() ?: "",
            "type" => "xvengine-bundle",
            "authors" => [
                [
                    "name" => $this->getAuthorName() ?: "",
                    "email" => $this->getAuthorEmail() ?: "",
                    "homepage" => $this->getAuthorUrl() ?: ""
                ]
            ],
            "require" => [
                "xvengine/core" => "1.*"
            ],
            "autoload" => [
                "psr-4" => [
                    $this->getNamespace() . "\\" => ""
                ]
            ],
            "extra" => [
                "xv-namespace" => $this->getNamespace() . "\\"
            ]
        ];
    }


}