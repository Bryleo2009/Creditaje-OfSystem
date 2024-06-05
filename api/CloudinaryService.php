<?php

namespace App\Services;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Background;
use Cloudinary\Tag\ImageTag;

class CloudinaryService
{
    public function __construct()
    {
        Configuration::instance('cloudinary://623467473972546:cJpalo1SBPxw9lqgm9E9OUIlS3U@ddjp7zbhb?secure=true');
    }

    public function uploadImage($imagePath, $publicId)
    {
        $uploadApi = new UploadApi();
        return $uploadApi->upload($imagePath, [
            'public_id' => $publicId,
            'use_filename' => true,
            'overwrite' => true
        ]);
    }

    public function getImageDetails($publicId)
    {
        $adminApi = new AdminApi();
        return $adminApi->asset($publicId, ['colors' => true]);
    }

    public function transformImage($publicId)
    {
        $imgtag = (new ImageTag($publicId))
            ->resize(Resize::pad()
                ->width(400)
                ->height(400)
                ->background(Background::predominant())
            );
        
        return $imgtag;
    }
}
