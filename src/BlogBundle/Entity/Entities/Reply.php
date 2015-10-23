<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Entity\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Description of Reply
 *
 * @author kimo
 */

/**
 * @Entity(repositoryClass="BlogBundle\Entity\Repositories\ReplyRepository")
 * @Table(name="reply")
 */
class Reply {
    //put your code here

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="text", nullable = false)
     * @NotNull()
     */
    protected $body;

    /**
     * @ManyToOne(targetEntity="Thread", inversedBy="repliesList")
     * @JoinColumn(name="thread", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    protected $thread;

    /**
     * @ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="repliesList")
     * @JoinColumn(name="user", referencedColumnName="id", nullable=false)
     * @NotNull()
     */
    protected $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Reply
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
     * Set thread
     *
     * @param \BlogBundle\Entity\Entities\Thread $thread
     *
     * @return Reply
     */
    public function setThread(\BlogBundle\Entity\Entities\Thread $thread = null) {
	$this->thread = $thread;

	return $this;
    }

    /**
     * Get thread
     *
     * @return \BlogBundle\Entity\Entities\Thread
     */
    public function getThread() {
	return $this->thread;
    }

    /**
     * Set user
     *
     * @param \BlogBundle\Entity\Entities\User $user
     *
     * @return Reply
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

}
