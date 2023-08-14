<?php

header('Content-Type: text/plain;charset=UTF-8');
$id = $_REQUEST['id'];
if ($id=='ardepg') { // ARD EPG video (MP4)
  echo 'video/mp4#http://itv.mit-xperts.com/hbbtvtest/media/trailer.php';
} else if ($id=='https') { // HTTPS video (MP4)
  echo 'video/mp4#https://itv.mit-xperts.com/video/dasgrossehansi.mp4';
} else if ($id=='mpegts') { // Test video (TS)
  echo 'video/mpeg#http://itv.mit-xperts.com/hbbtvtest/media/timecode.mpeg';
} else if ($id=='rtl') {
  echo 'video/mp4#http://bilder.rtl.de/tt_hd/trailer_hotelinspektor.mp4';
} else if ($id=='audiomp3') { // Audio stream (MP3)
  $m3u = @file_get_contents('http://streams.br.de/br-klassik_2.m3u');
  $m3u = strtok(str_replace("\r", "\n", $m3u), "\n");
  while ($m3u && substr($m3u, 0, 4)!='http') {
    $m3u = strtok("\n");
  }
  echo 'audio/mpeg#'.$m3u;
} else if ($id=='audiomp4') { // Test audio (MP4)
  echo 'audio/mp4#http://itv.mit-xperts.com/hbbtvtest/media/audio.php';
} else if ($id=='irthd') { // IRT test (HD, MP4)
  echo 'video/mp4#http://itv.mit-xperts.com/hbbtvtest/media/irthd.mp4';
} else if ($id=='tsstream') { // Live stream test (TS, no seeking!)
  echo 'video/mpeg#http://itv.mit-xperts.com/hbbtvtest/media/livestream.php';
} else if ($id=='olympia1') {
  echo 'video/mpeg#http://s2014.hbbtvlive.de/br/sotschi1';
} else {
  echo 'Unknown ID';
}
?>
