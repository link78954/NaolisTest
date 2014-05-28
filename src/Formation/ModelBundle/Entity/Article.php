<?php

namespace Formation\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Article
 *
 * @ORM\Table(name="Article")
 * @ORM\Entity(repositoryClass="Formation\ModelBundle\Repository\ArticleRepository")
 * @Assert\Callback(
 *      methods = {"isAuthorUnik"}
 *  )
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = "8",
     *      max = "40",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=100, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     * @Assert\Length(
     *      min = "40",
     *      minMessage = "Votre texte doit faire au moins {{ limit }} caractères"
     *  )
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publicatione", type="date", nullable=false)
     */
    private $datePublicatione;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;
    
    /**
     *
     * @var string
     * 
     * @ORM\ManyToOne(targetEntity="Formation\ModelBundle\Entity\User")
     */
    private $user;

    /**
     *
     * @var string
     * 
     * @ORM\OneToMany(targetEntity="Formation\ModelBundle\Entity\Com", mappedBy="article")
     */
    private $coms;
    
    /**
     *
     * @var string
     * 
     * @ORM\ManyToMany(targetEntity="Formation\ModelBundle\Entity\Cat", inversedBy="articles", cascade={"persist"})
     */
    private $cats;   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cats = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Article
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set datePublicatione
     *
     * @param \DateTime $datePublicatione
     * @return Article
     */
    public function setDatePublicatione($datePublicatione)
    {
        $this->datePublicatione = $datePublicatione;

        return $this;
    }

    /**
     * Get datePublicatione
     *
     * @return \DateTime 
     */
    public function getDatePublicatione()
    {
        return $this->datePublicatione;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Article
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set user
     *
     * @param \Formation\ModelBundle\Entity\article $user
     * @return Article
     */
    public function setUser(\Formation\ModelBundle\Entity\article $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Formation\ModelBundle\Entity\article 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add coms
     *
     * @param \Formation\ModelBundle\Entity\Com $coms
     * @return Article
     */
    public function addCom(\Formation\ModelBundle\Entity\Com $coms)
    {
        $this->coms[] = $coms;

        return $this;
    }

    /**
     * Remove coms
     *
     * @param \Formation\ModelBundle\Entity\Com $coms
     */
    public function removeCom(\Formation\ModelBundle\Entity\Com $coms)
    {
        $this->coms->removeElement($coms);
    }

    /**
     * Get coms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComs()
    {
        return $this->coms;
    }

    /**
     * Add cats
     *
     * @param \Formation\ModelBundle\Entity\Cat $cats
     * @return Article
     */
    public function addCat(\Formation\ModelBundle\Entity\Cat $cats)
    {
        $this->cats[] = $cats;

        return $this;
    }

    /**
     * Remove cats
     *
     * @param \Formation\ModelBundle\Entity\Cat $cats
     */
    public function removeCat(\Formation\ModelBundle\Entity\Cat $cats)
    {
        $this->cats->removeElement($cats);
    }

    /**
     * Get cats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCats()
    {
        return $this->cats;
    }
    
    public function isAuthorUnik(ExecutionContextInterface $context)
    {
        //$manager = $this->getDoctrine()->getManager();
        //$articleRepo = $manager->getRepository('FormationModelBundle:Article');
        
        $alreadyUseAuthors = array("toto");
                
        if (in_array ($this->getAuthor(), $alreadyUseAuthors))
        {
            $context->addViolationAt('author', 'Auteur doit être unique!', array(), null);
        }
        return 1;
    }
}
