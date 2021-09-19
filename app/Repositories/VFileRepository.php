<?php

namespace App\Repositories;

use App\Models\VFile;

class VFileRepository extends BaseRepository
{
    protected $vFile;

    public function __construct(VFile $vFile)
    {
        parent::__construct($vFile);
        $this->vFile = $vFile;
    }

    public function getAllPaginatedFiles(int $per_page)
    {
        return $this->vFile
            ->orderByDesc('created_at')
            ->simplePaginate($per_page);
    }

    public function searchPaginatedFiles(string $search, int $per_page)
    {
        return $this->vFile
            ->orderByDesc('created_at')
            ->where('model_id', 'LIKE', "%$search%")
            ->orWhere('model_name', 'LIKE', "%$search%")
            ->orWhere('field_name', 'LIKE', "%$search%")
            ->orWhere('file_type', 'LIKE', "%$search%")
            ->simplePaginate($per_page);
    }
}
