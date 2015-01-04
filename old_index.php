<!DOCTYPE html>
  <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <h1>Excuse Me!</h1>
    
    <?php
    // If we have POST data, we know that the form as just submitted. Fire the
    // missile and display a success message.
    if (!empty($_POST['name'])) {
      $fire = shell_exec('sudo python ' . $_SERVER['DOCUMENT_ROOT'] . '/attack.py ' . $_POST['name']);
      echo '<h2>Successfully Fired on ' . $_POST['name'] . '</h2>';
    }
    ?>
    
    <p>Is Jill zoned out? Does Kyle have his headphones on? Select the person who isn't paying attention to you and click "Fire!"</p>
    
    <form action="" id="attack-form" method="POST">
      <select name="name">
        <option value="jay">Jay</option>
        <option value="jill">Jill</option>
        <option value="kyle">Kyle</option>
        <option value="mike">Mike</option>
        <option value="adam">Adam</option>
        <option value="john">John</option>
      </select>
      <input type="submit" id="form-submit" value="Fire!" />
      <p><em>Allow up to 15 seconds for the system to acquire missle lock on the target.</em></p>
    </form>

    <p>Are you trying to get the attention of someone who isn't on the list? Unfortunately, our missle launcher has limited range and is easily deflected by materials like glass.</p>
    
    <div id="status">Please Standby. Acquiring Target...</div>
    
    <script>
    // Eye candy
    $(document).ready(function() {
      /**
       * Array to define status messages after the Fire button is clicked
       *   @key - number of miliseconds after button is clicked
       *   @value - the message that will be displayed
       */
      var statuses = {
        '3000' : 'Calculating coordinates...',
        '6100' : 'Adjusting for coriolis effect...',
        '9300' : 'Rounding up to the nearest 10...',
        '11000' : 'Firing!', // About 11 seconds for mine to start firing
      }
      
      // On click of the fire button, fade in the overlay and cycle through
      // the status messages until the page reloads
      $('#form-submit').click(function() {
        $('#status').fadeIn();
        $.each(statuses, function( delay, message ) {
          setTimeout(function() {
            updateStatus(message);
          }, delay);
        });
      });
      
      // Function that actually replaces the text in #status (overlay) div
      function updateStatus(message) {
        $('#status').text(message);
      }
    });
    </script>

  </body>
</html>

