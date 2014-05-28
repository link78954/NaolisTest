<?php

namespace Formation\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Com
 *
 * @ORM\Table(name="Com")
 * @ORM\Entity(repositoryClass="Formation\ModelBundle\Repository\ComRepository")
 */
class Com
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
     * @ORM\Column(name="author", type="string", length=100, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_pubication", type="date", nullable=false)
     */
    private $datePubication;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delete", type="boolean", nullable=false)
     */
    private $isDelete;

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
     * @ORM\ManyToOne(targetEntity="Formation\ModelBundle\Entity\Article", inversedBy="coms")
     */
    private $article;


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
     * Set author
     *
     * @param string $author
     * @return Com
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
     * @return Com
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
     * Set datePubication
     *
     * @param \DateTime $datePubication
     * @return Com
     */
    public function setDatePubication($datePubication)
    {
        $this->datePubication = $datePubication;

        return $this;
    }

    /**
     * Get datePubication
     *
     * @return \DateTime 
     */
    public function getDatePubication()
    {
        return $this->datePubication;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Com
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set user
     *
     * @param \Formation\ModelBundle\Entity\User $user
     * @return Com
     */
    public function setUser(\Formation\ModelBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Formation\ModelBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set article
     *
     * @param \Formation\ModelBundle\Entity\Article $article
     * @return Com
     */
    public function setArticle(\Formation\ModelBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Formation\ModelBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
