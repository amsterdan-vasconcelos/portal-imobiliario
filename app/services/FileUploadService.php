<?php

namespace App\services;

class FileUploadService
{
  public function __construct(private string $uploadDir) {}

  public function upload(array $file)
  {
    if (!empty($file['name'])) {
      $fileName = uniqid() . $file['name'];
      $fileDir = $this->uploadDir . '/' . $fileName;
      move_uploaded_file($file['tmp_name'], $fileDir);

      return $fileName;
    }

    return null;
  }
}
