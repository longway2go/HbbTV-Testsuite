<?php
$vidfile = 'doorbell.aac';
$size = filesize($vidfile); // the size of doorbell.aac
$mtime = filemtime($vidfile); // the last modified time for the doorbell.aac

$fp = @fopen($vidfile,'rb'); // get the file handle

// handle null or file size is 0, respond 404
if (!$fp || !$size) {
  header('HTTP/1.0 404 Not Found');
  echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\n
        <html>
            <head>\n
                <title>404 Not Found</title>\n
            </head>
            <body>\n
                <h1>Not Found</h1>\n
                <p>The requested URL was not found on this server.</p>\n
            </body>
        </html>";
  exit;
}

// respond the doorbell.aac file stream
header('Last-Modified: '.gmdate("D, d M Y H:i:s", $mtime)." GMT");
header('Accept-Ranges: none');
header('Content-Length: '.$size);
header('Content-Type: audio/mp4');

# start streaming
while (!feof($fp) && !connection_aborted()) {
  echo @fread($fp, 8192);
}
fclose($fp);

?>
