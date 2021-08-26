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
}
