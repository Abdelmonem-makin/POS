<?php

define('PAGINTION',5);

 
function uploadImage($folder , $image){
    $image -> store('/',$folder);
    $filename = $image->hashName();
    $path ='images/'.$folder.'/'.$filename;
    return $path;
}
