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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Description of Category
 *
 * @author kimo
 */

/**
 * @Entity(repositoryClass="BlogBundle\Entity\Repositories\CategoryRepository")
 * @Table(name="category")
 */
class Category {
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
     */
    protected $name;

    /**
     * @Column(type="text", nullable = false)
     * @NotNull()
     */
    protected $description;

    /**
     * @Column(type="string", length=255, unique=true, nullable = true)
     */
    protected $photoDirectory;

    /**
     * @OneToMany(targetEntity="Forum", mappedBy="category", cascade={"all"})
     */
    protected $forumsList;

    public function __construct($id = NULL) {
	$this->forumsList = new ArrayCollection();
	$this->id = $id;
    }

    private $image;

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
     * @return Category
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
     * Set photoDirectory
     *
     * @param string $photoDirectory
     *
     * @return Category
     */
    public function setPhotoDirectory($photoDirectory) {
	$this->photoDirectory = $photoDirectory;

	return $this;
    }

    /**
     * Get photoDirectory
     *
     * @return string
     */
    public function getPhotoDirectory() {
	return $this->photoDirectory;
    }

    /**
     * Add forumsList
     *
     * @param \BlogBundle\Entity\Entities\Forum $forumsList
     *
     * @return Category
     */
    public function addForumsList(\BlogBundle\Entity\Entities\Forum $forumsList) {
	$this->forumsList[] = $forumsList;

	return $this;
    }

    /**
     * Remove forumsList
     *
     * @param \BlogBundle\Entity\Entities\Forum $forumsList
     */
    public function removeForumsList(\BlogBundle\Entity\Entities\Forum $forumsList) {
	$this->forumsList->removeElement($forumsList);
    }

    /**
     * Get forumsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForumsList() {
	return $this->forumsList;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
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

    public function getImage() {
	return $this->image;
    }

    public function setImage($image) {
	$this->image = $image;
	return $this;
    }

}
