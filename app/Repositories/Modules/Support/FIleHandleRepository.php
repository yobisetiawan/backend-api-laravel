<?php

namespace App\Repositories\Modules\Support;

use App\Models\Token;
use App\Models\User;
use App\Repositories\Repository;
use Carbon\Carbon;


class FIleHandleRepository extends Repository
{
    private $file;
    private $path;
    private $disk;
    private $file_info = [];

    public function __construct($file = null, $data = ['path' => '', 'file_name' => ''], $disk = 's3')
    {
        $this->disk = $disk;
        $this->file = $file;

        if ($file) {
            $file_full_name = $data['file_name'] . '.' . $file->getClientOriginalExtension();

            $this->path = $data['path'] . $file_full_name;
            $this->file_info = [
                'original_name' => $file->getClientOriginalName(),
                'original_extension' => $file->getClientOriginalExtension(),
                'original_size' => $file->getSize(),
                'original_mimetype' => $file->getMimeType(),
                'name' => $data['file_name'],
                'file_full' => $file_full_name,
                'disk' => $disk,
                'disk_path' => $data['path'],
                'bucket' => config('filesystems.disks.' . $disk . '.bucket'),
                'region' => config('filesystems.disks.' . $disk . '.region'),
                'endpoint' => config('filesystems.disks.' . $disk . '.endpoint')
            ];
        }
    }

    public function resizeImage($width, $height, $func = null)
    {
        $img = \Image::make(file_get_contents($this->file))->resize($width, $height, $func);
        $this->file = $img->stream()->detach();
        $this->img_stream = true;
        return $img;
    }

    public function upload($option)
    {
        return \Storage::disk($this->disk)->put($this->path, $this->getFile(), $option);
    }

    public function getUrl()
    {
        return \Storage::disk($this->disk)->url($this->path);
    }

    public function store($owner, string $relation)
    {
        $data = [
            'url' => $this->getUrl(),
            'path' => $this->path,
            'data' => json_encode($this->file_info),
            'slug' => $relation
        ];

        if ($owner->$relation) {
            return $owner->$relation()->update($data);
        }

        return $owner->$relation()->create($data);
    }



    private function getFile()
    {
        return $this->img_stream ? $this->file : file_get_contents($this->file);
    }
}
