<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BlogBundle\Entity\Entities;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

/**
 * Description of Document
 *
 * @author kimo
 */
class Document {

    /**
     * @File(maxSize="6000000")
     */
    private $file;
    public $path;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
	$this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
	return $this->file;
    }

    public function getAbsolutePath() {
	return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
	return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir() {
	// the absolute directory path where uploaded
	// documents should be saved
	return __DIR__ . '/../../Resources/Uploaded-images/Categories/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
	// get rid of the __DIR__ so it doesn't screw up
	// when displaying uploaded doc/image in the view.
	return 'uploads/documents';
    }

    public function upload() {
	// the file property can be empty if the field is not required
	if (null === $this->getFile()) {
	    return;
	}

	// use the original file name here but you should
	// sanitize it at least to avoid any security issues
	// move takes the target directory and then the
	// target filename to move to
	$this->getFile()->move(
		$this->getUploadRootDir(), $this->getFile()->getClientOriginalName()
	);

	// set the path property to the filename where you've saved the file
	$this->path = $this->getFile()->getClientOriginalName();

	// clean up the file property as you won't need it anymore
	$this->file = null;
    }

}
