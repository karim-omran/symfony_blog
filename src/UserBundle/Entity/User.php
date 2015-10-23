<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @Table()
 * @Entity(repositoryClass="UserRepository")
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=6, nullable = true)
     */
    protected $gender;

    /**
     * @Column(type="date", nullable = true)
     */
    protected $birtDate;

    /**
     * @Column(type="date", nullable = true)
     */
    protected $joinDate;

    /**
     * @Column(type="string", length=32, nullable = true)
     */
    protected $country;

    /**
     * @Column(type="string", length=64, nullable = true)
     */
    protected $signature;

    /**
     * @Column(type="string", length=255, unique=true, nullable = true)
     */
    protected $photoDirectory;

    /**
     * @Column(type="boolean", nullable = true)
     */
    protected $loggedIn;

    /**
     * @OneToMany(targetEntity="BlogBundle\Entity\Entities\Thread", mappedBy="user")
     */
    protected $threadsList;

    /**
     * @OneToMany(targetEntity="BlogBundle\Entity\Entities\Reply", mappedBy="user")
     */
    protected $repliesList;

    public function __construct() {
	parent::__construct();
	$this->threadsList = new ArrayCollection();
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
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender) {
	$this->gender = $gender;

	return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender() {
	return $this->gender;
    }

    /**
     * Set birtDate
     *
     * @param \DateTime $birtDate
     *
     * @return User
     */
    public function setBirtDate($birtDate) {
	$this->birtDate = $birtDate;

	return $this;
    }

    /**
     * Get birtDate
     *
     * @return \DateTime
     */
    public function getBirtDate() {
	return $this->birtDate;
    }

    /**
     * Set joinDate
     *
     * @param \DateTime $joinDate
     *
     * @return User
     */
    public function setJoinDate($joinDate) {
	$this->joinDate = $joinDate;

	return $this;
    }

    /**
     * Get joinDate
     *
     * @return \DateTime
     */
    public function getJoinDate() {
	return $this->joinDate;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country) {
	$this->country = $country;

	return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry() {
	return $this->country;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return User
     */
    public function setSignature($signature) {
	$this->signature = $signature;

	return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature() {
	return $this->signature;
    }

    /**
     * Set photoDirectory
     *
     * @param string $photoDirectory
     *
     * @return User
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
     * Set loggedIn
     *
     * @param boolean $loggedIn
     *
     * @return User
     */
    public function setLoggedIn($loggedIn) {
	$this->loggedIn = $loggedIn;

	return $this;
    }

    /**
     * Get loggedIn
     *
     * @return boolean
     */
    public function getLoggedIn() {
	return $this->loggedIn;
    }

    /**
     * Add threadsList
     *
     * @param \UserBundle\Entity\Thread $threadsList
     *
     * @return User
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
     * Add repliesList
     *
     * @param \BlogBundle\Entity\Entities\Reply $repliesList
     *
     * @return User
     */
    public function addRepliesList(\BlogBundle\Entity\Entities\Reply $repliesList) {
	$this->repliesList[] = $repliesList;

	return $this;
    }

    /**
     * Remove repliesList
     *
     * @param \UserBundle\Entity\Reply $repliesList
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
