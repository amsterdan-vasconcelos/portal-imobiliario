<?php

namespace App\services;

use App\Models\PropertyImage;
use App\DAO\PropertyImageDAO;

class PropertyImageService
{
  private string $uploadDir = __DIR__ . '/../../public/storage/property-images/';

  public function __construct(
    private $propertyImageDAO = new PropertyImageDAO()
  ) {
    if (!is_dir($this->uploadDir)) {
      mkdir($this->uploadDir, 0777, true);
    }
  }

  /**
   * @param array $files ($_FILES['images']) formato
   * @param int|string $propertyId
   * @return PropertyImage[]
   */
  public function uploadMultiple(array $files, int|string $propertyId): array
  {
    try {
      $fileCount = count($files['name']);

      for ($i = 0; $i < $fileCount; $i++) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK) {
          continue;
        }

        $tmpName = $files['tmp_name'][$i];
        $originalName = $files['name'][$i];
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);

        $newFileName = uniqid('img_', true) . '.' . $extension;
        $destination = $this->uploadDir . "$propertyId/";

        if (!is_dir($destination)) {
          mkdir($destination, 0777, true);
        }

        $destination = $destination . $newFileName;

        if (move_uploaded_file($tmpName, $destination)) {
          $imagePath = 'storage/property-images/' . $newFileName;


          $image = new PropertyImage($imagePath, $propertyId);
          $this->propertyImageDAO->register($image);
        }
      }

      return ['success' => 'Imagem cadastrada com sucesso'];
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }
  }
}
