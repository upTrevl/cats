<?php

namespace App\Repositories;

use App\Entities\FileEntity;
use App\Models\File;
use App\Models\File as FileModel;

class FilesRepository
{
    public function store(FileEntity $catEntity): File
    {
        $fileModel = new FileModel();

        $fileModel->name = $catEntity->name;
        $fileModel->storage_name = $catEntity->storage_name;
        $fileModel->type = $catEntity->type;
        $fileModel->save();

        return $fileModel;
    }
}
