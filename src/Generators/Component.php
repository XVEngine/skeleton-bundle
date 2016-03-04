<?php
namespace XVEngine\Bundle\SkeletonBundle\Generators;


class Component
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $tagName;

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

    /**
     * Get tagName value
     * @author Krzysztof Bednarczyk
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Set tagName value
     * @author Krzysztof Bednarczyk
     * @param string $tagName
     * @return  $this
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        return $this;
    }




}