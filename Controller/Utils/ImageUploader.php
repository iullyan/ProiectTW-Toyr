<?php


class ImageUploader
{

    public function uploader($image, $uploadDirectoryPath) {

        if($errMsg = $this->validateImage($image)){
            move_uploaded_file($image['tmp_name'],"$uploadDirectoryPath". $image['name']);
            return true;
        } else{
            return $errMsg;
        }

    }

    private function validateImage($image) {

        $fileName = $image['name'];
        $file_size =$image['size'];
        $file_ext=strtolower(end(explode('.', $fileName)));

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false)
           return "Extension not allowed, please choose a JPEG or PNG file.";

        if($file_size > 2097152)
            return "File size must be excately 2 MB";

        return true;

    }

}