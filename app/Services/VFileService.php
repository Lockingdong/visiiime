<?php

namespace App\Services;

use App\Repositories\VFileRepository;
use App\Models\VFile;
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

    public function createImage(VFile $vFile, $file, int $size = 500): string
    {
        $createdFile = $this->vFileRepository->create($vFile);
        $path = $this->saveImage($file, $size);

        $this->vFileRepository->update($createdFile->id, [
            'file_path' => $path['path']
        ]);

        return $path['path'];
    }

    private function saveImage($file, int $size): array
    {
        $extension = $file->getClientOriginalExtension();
        if(!in_array($extension, ['jpg', 'jpeg', 'png'])) {
            throw new Exception('image file not allow');
        }

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
