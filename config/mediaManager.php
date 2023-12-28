<?php

use Modules\Ynotz\MediaManager\Services\GalleryService;

    return [
        'temp_disk' => 'public',
        'temp_folder' => 'tmp',
        'images_disk' => 'local',
        'videos_disk' => 'local',
        'files_disk' => 'local',
        'images_folder' => 'public/images',
        'videos_folder' => 'public/videos',
        'files_folder' => 'public/files',
        'gallery_service' => GalleryService::class,
        'gallery_route' => 'mediamanager.gallery',
        'ulid_separator' => '_ulid::'
    ];
?>
