<?php

namespace app\uploads;

use Yii;

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

// files storage folder
$dir = dirname(__FILE__) . '/';

$_FILES['file']['type'] = strtolower($_FILES['file']['type']);

if ($_FILES['file']['type'] === 'application/pdf'
    || $_FILES['file']['type'] === 'application/msword'
    || $_FILES['file']['type'] === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    || $_FILES['file']['type'] === 'application/vnd.ms-excel'
    || $_FILES['file']['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    || $_FILES['file']['type'] === 'application/vnd.ms-powerpoint'
    || $_FILES['file']['type'] === 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
) {
    // setting file's mysterious name
    $name = explode('.', $_FILES['file']['name']);
    $ext = end($name);
    $filename = md5(date('YmdHis')) . '.' . $ext;
    $file = $dir . $filename;

    // copying
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    $fileLink = '../../uploads/files/' . $filename;

    // displaying file
    $array = array(
        'filelink' => $fileLink
    );

    echo stripslashes(json_encode($array));

    // Add it to json for later display
    $imageJsonFile = file_get_contents('files.json');
    $images = json_decode($imageJsonFile);
    $images[] = [
        'title' => $_FILES['file']['name'],
        'name' => $_FILES['file']['name'],
        'link' => $fileLink,
        'size' => formatSizeUnits($_FILES['file']['size'])
    ];
    file_put_contents('files.json', json_encode($images));
}

?>