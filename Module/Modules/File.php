<?php

class File
{
    private static array $_allowedMimetypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];

    public static array $errors = [];

    public static function upload($fileName, $fileTmpPath, $fileType, $fileSize): string|bool
    {

        if (!in_array($fileType, self::$_allowedMimetypes)) {
            self::$errors[] = "Invalid file type.";
            return false;
        }

        if ($fileSize >= 10000000) {
            self::$errors[] = 'File size must be excately 2 MB';
            return false;
        }

        $uploadFileDir = 'storage/images/';
        $dest_path = $uploadFileDir . $fileName;

        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            self::$errors[] = "Failed to upload the file.";
            return false;
        }

        return 'http://localhost:8000/' . $dest_path;
    }
}