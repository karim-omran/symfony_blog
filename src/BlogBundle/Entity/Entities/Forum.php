<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Entity\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of Forum
 *
 * @author kimo
 */

/**
 * @Entity(repositoryClass="BlogBundle\Entity\Repositories\ForumRepository")
 * @Table(name="forum")
 * @UniqueEntity(fields={"name"}, message="Forum Name Must Be Unique")
 */
class Forum {
    //put your code here

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=255, unique=true, nullable = false)
     * @NotNull()
     *
     */
    protected $name;

    /**
     * @Column(type="text", nullable = false)
     * @NotNull()
     */
    protected $description;

    /**
     * @Column(type="boolean", nullable = false)
     * @NotNull()
     */
    protected $closed;

    /**
     * @ManyToOne(targetEntity="Category", inversedBy="forumsList", cascade={"persist", "merge"})
     * @JoinColumn(name="category", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    protected $category;

    /**
     * @OneToMany(targetEntity="Thread", mappedBy="forum")
     */
    protected $threadsList;

    public function __construct($categoryId = NULL) {
	$this->threadsList = new ArrayCollection();
	$this->category = new Category($categoryId);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Forum
     */
    public function setName($name) {
	$this->name = $name;

	return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
	return $this->name;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Forum
     */
    public function setClosed($closed) {
	$this->closed = $closed;

	return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed() {
	return $this->closed;
    }

    /**
     * Set category
     *
     * @param \BlogBundle\Entity\Entities\Category $category
     *
     * @return Forum
     */
    public function setCategory(\BlogBundle\Entity\Entities\Category $category = null) {
	$this->category = $category;

	return $this;
    }

    /**
     * Get category
     *
     * @return \BlogBundle\Entity\Entities\Category
     */
    public function getCategory() {
	return $this->category;
    }

    /**
     * Add threadsList
     *
     * @param \BlogBundle\Entity\Entities\Thread $threadsList
     *
     * @return Forum
     */
    public function addThreadsList(\BlogBundle\Entity\Entities\Thread $threadsList) {
	$this->threadsList[] = $threadsList;

	return $this;
    }

    /**
     * Remove threadsList
     *
     * @param \BlogBundle\Entity\Entities\Thread $threadsList
     */
    public function removeThreadsList(\BlogBundle\Entity\Entities\Thread $threadsList) {
	$this->threadsList->removeElement($threadsList);
    }

    /**
     * Get threadsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThreadsList() {
	return $this->threadsList;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Forum
     */
    public function setDescription($description) {
	$this->description = $description;

	return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
	return $this->description;
    }

}
