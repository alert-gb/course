<?
function uploadFile($folder, $file) {
    $file->store('/', $folder);
    $filename = $file->hashName();
    $path = 'images/categories' . $folder . '/' . $filename;
    
    return $path;
}