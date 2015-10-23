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

/**
 * Description of Thread
 *
 * @author kimo
 */

/**
 * @Entity(repositoryClass="BlogBundle\Entity\Repositories\ThreadRepository")
 * @Table(name="thread")
 */
class Thread {
    //put your code here

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=256)
     * @NotNull()
     */
    protected $title;

    /**
     * @Column(type="text")
     * @NotNull()
     */
    protected $body;

    /**
     * @Column(type="datetime")
     * @NotNull()
     */
    protected $createTime;

    /**
     * @Column(type="boolean")
     * @NotNull()
     */
    protected $sticky;

    /**
     * @Column(type="boolean")
     * @NotNull()
     */
    protected $closed;

    /**
     * @ManyToOne(targetEntity="Forum", inversedBy="threadsList", cascade={"persist", "merge"})
     * @JoinColumn(name="forum", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    protected $forum;

    /**
     * @ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="threadsList", cascade={"persist", "merge"})
     * @JoinColumn(name="user", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    protected $user;

    /**
     * @OneToMany(targetEntity="Reply", mappedBy="thread", cascade={"all"})
     */
    protected $repliesList;

    public function __construct() {
	$this->repliesList = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Thread
     */
    public function setTitle($title) {
	$this->title = $title;

	return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
	return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Thread
     */
    public function setBody($body) {
	$this->body = $body;

	return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody() {
	return $this->body;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return Thread
     */
    public function setCreateTime($createTime) {
	$this->createTime = $createTime;

	return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime() {
	return $this->createTime;
    }

    /**
     * Set sticky
     *
     * @param boolean $sticky
     *
     * @return Thread
     */
    public function setSticky($sticky) {
	$this->sticky = $sticky;

	return $this;
    }

    /**
     * Get sticky
     *
     * @return boolean
     */
    public function getSticky() {
	return $this->sticky;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Thread
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
     * Set forum
     *
     * @param \BlogBundle\Entity\Entities\Forum $forum
     *
     * @return Thread
     */
    public function setForum(\BlogBundle\Entity\Entities\Forum $forum = null) {
	$this->forum = $forum;

	return $this;
    }

    /**
     * Get forum
     *
     * @return \BlogBundle\Entity\Entities\Forum
     */
    public function getForum() {
	return $this->forum;
    }

    /**
     * Set user
     *
     * @param \BlogBundle\Entity\Entities\User $user
     *
     * @return Thread
     */
    public function setUser(\UserBundle\Entity\User $user = null) {
	$this->user = $user;

	return $this;
    }

    /**
     * Get user
     *
     * @return \BlogBundle\Entity\Entities\User
     */
    public function getUser() {
	return $this->user;
    }

    /**
     * Add repliesList
     *
     * @param \BlogBundle\Entity\Entities\Reply $repliesList
     *
     * @return Thread
     */
    public function addRepliesList(\BlogBundle\Entity\Entities\Reply $repliesList) {
	$this->repliesList[] = $repliesList;

	$repliesList->setThread($this);

	return $this;
    }

    /**
     * Remove repliesList
     *
     * @param \BlogBundle\Entity\Entities\Reply $repliesList
     */
    public function removeRepliesList(\BlogBundle\Entity\Entities\Reply $repliesList) {
	$this->repliesList->removeElement($repliesList);
    }

    /**
     * Get repliesList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRepliesList() {
	return $this->repliesList;
    }

}
