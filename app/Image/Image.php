<?php

namespace App\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
    protected $file;

    protected $base_path;

    protected $location;

    public function __construct(UploadedFile $file)
    {
        $this->file       = $file;
        $this->base_path  = 'jobboard/images/';
    }

    public function save($height = 100, $width = 100)
    {
        $filepath = $this->path($this->name());

        $image = \Image::make($this->file)->fit($height, $width)->stream()->__toString();

        \Storage::put($filepath, $image);

        $this->location = $filepath;

        return $this->location();
    }

    public function name()
    {
        return time() . $this->file->getClientOriginalName();
    }

    public function extension()
    {
        return $this->file->getClientOriginalExtension();
    }

    public function path($directory)
    {
        return $this->base_path . $directory;
    }

    public function location()
    {
        return $this->location;
    }
}
