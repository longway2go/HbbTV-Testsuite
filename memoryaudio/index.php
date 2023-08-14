<?php
$ROOTDIR='..';
require("$ROOTDIR/base.php");
$url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/stream.php/test.aac';

sendContentType();
openDocument('MIT-xperts HBBTV testsuite', 1, '');

?>
<script type="text/javascript">
//<![CDATA[
var req = false;
var testPrefix = <?php echo json_encode(getTestPrefix()); ?>;

window.onload = function() {
  // select sub-menu 0
  menuInit();

  registerMenuListener(function(liid) {
    if (liid=='exit') {
      document.location.href = '../index.php';
    } else {
      // the menu has only two sub-menu: play and exit.
      // so this liid must be 'play'
      runStep(liid);
    }
  });
  initApp();
  setInstr('Try to run play multiple times to play back memory cached audio clip. At least after the first playback, later playbacks should (maybe) occur instantly.');
  runNextAutoTest();
};

function runStep(name) {
  if (name=='play') {
    // stop the audio if it's playing
    try {
      document.getElementById('aud').stop();
    } catch (e) {
      // ignore
    }

    // play the audio 2 times
    try {
      document.getElementById('aud').play(1);
      showStatus(true, 'Playback started, check audio (audio clip should be played 2 times).');
    } catch (e) {
      showStatus(false, 'Playback failed.');
    }
  }
}

//]]>
</script>

</head><body>

<div style="left: 0px; top: 0px; width: 1280px; height: 720px; background-color: #132d48;" />

<object type="audio/mp4" id="aud" data="<?php echo $url; ?>">
<param name="cache" value="true" />
<param name="loop" value="2" />
</object>
<?php echo appmgrObject(); ?>

<div class="txtdiv txtlg" style="left: 110px; top: 60px; width: 500px; height: 30px;">MIT-xperts HBBTV tests</div>
<div id="instr" class="txtdiv" style="left: 700px; top: 110px; width: 400px; height: 360px;"></div>
<ul id="menu" class="menu" style="left: 100px; top: 100px;">
  <li name="play" automate="audio">Play door bell sound</li>
  <li name="exit">Return to test menu</li>
</ul>
<div id="status" style="left: 700px; top: 480px; width: 400px; height: 200px;"></div>

</body>
</html>
