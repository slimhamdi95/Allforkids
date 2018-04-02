<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 30/03/2018
 * Time: 16:39
 */

namespace AllForKids\DivertissementBundle;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}