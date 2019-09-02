<?php

namespace AdminBundle\Forms\Model;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadProductListModel
{

    private $file;

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }
}