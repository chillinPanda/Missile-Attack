## ATTACK! - A fork of Retaliation for use with php script


### Summary
http://www.joelonsoftware.com/articles/fog0000000043.html

> Do programmers have quiet working conditions?

Hell no! That's why they all wear headphones! But how do you get their
attention without looking like an idiot? ("scuse me. ummm. Jill? can you 
hear me? Scuse me")

Attack! solves this problem.

### How to Use
  1.  Install Apache and PHP on your Raspberry Pi. The user running Apache 
      (www-data by default) needs to be able to execute sudo commands without
      entering a password.

      E.g. in /etc/sudoers: `www-data ALL=(ALL) NOPASSWD: ALL`
      Hint: use sudo visudo to edit sudoers file.


  2.  Modify your `COMMAND_SETS` in the `attack.py` script to define your 
      targeting commands for each one of your d programmers. A command set is 
      an array of move and fire commands. It is recommend to start each 
      command set with a "zero" command.  This parks the launcher in a known
      position (bottom-left).  You can then use "up" and "right" followed by a 
      time (in milliseconds) to position your fire.
 
      You can test a set by calling attack.py with the target name. e.g.:  

           python attack.py "[developer's user name]"

      Trial and error is the best approach. Consider doing this secretly after
      hours for best results!

  3.  Download the Missle Attack! source code from github
      (https://github.com/balsama/Missile-Attack) and place it in your web 
      root directory.

  4.  Modify the select list in index.php to match the names of your developers
      defined in the COMMAND_SETS in attack.py.

  5.  Install Python PyUSB Support (http://sourceforge.net/projects/pyusb/)

  6.  Mount your <a href="http://www.dreamcheeky.com/thunder-missile-launcher">Dream Cheeky Thunder USB Missile Launcher</a> 
      in a central and fixed location and connect it to your Raspberry Pi.

  7.  The next time someone is ignoring you, load up the index.php file in a 
      browser and fire away!

####  Requirements:

  * A <a href="http://www.dreamcheeky.com/thunder-missile-launcher">Dream Cheeky Thunder USB Missile Launcher</a>. 
  * Python 2.6+
  * Python PyUSB Support (http://sourceforge.net/projects/pyusb/)  
  * A Raspberry Pi 
