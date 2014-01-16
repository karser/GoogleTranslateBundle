<?php
namespace Karser\GoogleTranslateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class GoogleTranslation
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @var string
     */
    protected $source;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @var string
     */
    protected $target;

    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @var string
     */
    protected $original;

    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @var string
     */
    protected $translated;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return GoogleTranslation
     */
    public function setSource($source)
    {
        $this->source = $source;
    
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set target
     *
     * @param string $target
     * @return GoogleTranslation
     */
    public function setTarget($target)
    {
        $this->target = $target;
    
        return $this;
    }

    /**
     * Get target
     *
     * @return string 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set original
     *
     * @param string $original
     * @return GoogleTranslation
     */
    public function setOriginal($original)
    {
        $this->original = $original;
    
        return $this;
    }

    /**
     * Get original
     *
     * @return string 
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set translated
     *
     * @param string $translated
     * @return GoogleTranslation
     */
    public function setTranslated($translated)
    {
        $this->translated = $translated;
    
        return $this;
    }

    /**
     * Get translated
     *
     * @return string 
     */
    public function getTranslated()
    {
        return $this->translated;
    }
}