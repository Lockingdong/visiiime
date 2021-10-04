<?php

namespace App\Services;

use App\Repositories\VFileRepository;
use App\Models\VFile;
use File;
use Exception;
use Str;
use Intervention\Image\Facades\Image;

class VFileService extends BaseService
{
    protected $vFileRepository;

    public function __construct(
        VFileRepository $vFileRepository
    )
    {
        $this->vFileRepository = $vFileRepository;
    }

    public function getAllPaginatedFiles(int $per_page)
    {
        return $this->vFileRepository->getAllPaginatedFiles($per_page);
    }

    public function searchPaginatedFiles(string $search, int $per_page)
    {
        return $this->vFileRepository->searchPaginatedFiles($search, $per_page);
    }

    public function createImageVFile(VFile $vFile, $file, int $size = 500): string
    {
        $createdFile = $this->vFileRepository->create($vFile);
        $path = $this->saveImage($file, $size);

        $this->vFileRepository->update($createdFile->id, [
            'file_path' => $path['path']
        ]);

        return $path['path'];
    }

    public function deleteImageVFile(string $vFileId): bool
    {
        $vFile = $this->vFileRepository->find($vFileId);

        if(empty($vFile)) {
            throw new Exception("vFile id : $vFileId not found ");
        }

        $this->deleteImage($vFile->file_path);

        return $this->vFileRepository->destroyBy('id', $vFileId);
    }

    private function deleteImage(string $filePath): void
    {
        File::delete(public_path($filePath));
    }

    private function saveImage($file, int $size): array
    {
        $extension = 'png';

        $folder = date('Y/m/d');
        $uploadPath = public_path() . '/images/upload/' . $folder;

        $filename = time() . '_' . Str::random(10) . '.' . $extension;
        $file->move($uploadPath, $filename);

        $filePath  = $uploadPath . '/' . $filename;

        $this->reduceSize(
            $filePath,
            $size
        );

        return [
            'path' => '/images/upload/' . $folder . '/' . $filename
        ];
    }

    private function reduceSize(string $filePath, int $width): void
    {
        $image = Image::make($filePath);

        $image->resize($width, null, function ($constraint) {

            $constraint->aspectRatio();

            $constraint->upsize();
        });

        $image->save();
    }
}
