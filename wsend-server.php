<?php
/**
 * wsend server in PHP
 * Author: Benjamin Altpeter (http://benjamin-altpeter.de)
 * GitHub: http://github.com/baltpeter/wsend-server-php
 * License: The MIT License (see LICENSE.md)
 */

// preferences
$server_url = 'http://10.1.1.3';     // make sure to include the protocol (i.e. http:// or https://)
$upload_dir = '/var/www/uploads/';   // make sure the web server can write to this directory but it is not accessible from the web; has to end with a slash
// end preferences


switch ($_GET['param']) {
    case 'upload_cli':
        // generate UUID, see http://rogerstringer.com/2013/11/15/generate-uuids-php/
        $uuid = sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        $file = $upload_dir . basename($uuid) . '-' .  basename($_FILES['filehandle']['name']);

        if (move_uploaded_file($_FILES['filehandle']['tmp_name'], $file)) {
            echo $server_url . '/' . $uuid . '/' . basename($_FILES['filehandle']['name']);
        }
        break;
    case 'get_file';
        $file = $upload_dir . $_GET['uuid']. '-' . $_GET['file_name'];

        if (file_exists($file)) {
            header('Content-Type: ' . finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file));
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
        else {
            header("HTTP/1.0 404 Not Found");
            echo 'Specified file does not exist.';
        }
        break;
    default:
        echo '<h1>wsend server at ' . $server_url . '</h1>';
        echo 'see <a href="https://github.com/baltpeter/wsend-server-php">https://github.com/baltpeter/wsend-server-php</a> for more information';
        break;
}
