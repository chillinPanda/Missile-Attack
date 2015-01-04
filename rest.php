<?php
    /**
     * This is a REST api for the attack.py script. 
     * 
     * usage: rest.php?cmd=right&val=500
     */
?>

<!DOCTYPE html>
  <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    
      
<?php
if (!empty($_GET['cmd']) && !empty($_GET['val'])) {
  $cmd = 'sudo python ' . $_SERVER['DOCUMENT_ROOT'] . '/attack.py ' . $_GET['cmd'] . ' ' . $_GET['val'];
  $fire = shell_exec($cmd);
  echo '<h1>Send command: ' . $cmd . '</h1>';
} else {
  echo '<h1>not enough parameter</h1>';
  echo '<p>usage: rest.php?cmd=right&val=500</p>';
}
?>
	
      <h2>Demo Buttons</h2>
      <p>jQuery.get() is used to fire a get request to the api</p>
      <ul>
        <li><a onclick="$.get( '?cmd=right&val=500');">go right 500 ms</a></li>
        <li><a onclick="$.get( '?cmd=left&val=500');">go left 500 ms</a></li>
        <li><a onclick="$.get( '?cmd=up&val=500');">go up 500 ms</a></li>
        <li><a onclick="$.get( '?cmd=down&val=500');">go down 500 ms</a></li>
        <li><a onclick="$.get( '?cmd=zero&val=1');">go to zero</a></li>
      </ul>
  </body>
</html>