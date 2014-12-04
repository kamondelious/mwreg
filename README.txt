mwreg web site for registration for mech warfare events
=======================================================

This is a work in progress, building a small web site to manage people, teams, 
mechs, and events. The code is purposefully simplistic and doesn't use any 
frameworks, to make moving to whatever hosting provider and environment simpler.
The code assumes PHP 5.3 and a MySQL database.
Configuration lives in config.php

General structure
=================

This is a basic PHP application, and the structure is very simplistic.
It uses no framework. It uses PDO for MySQL. My host runs PHP 5.3 so I don't use 
lambda functions or the like.

The application logic lives in top-level pages. POST handling and the like happens 
in a script in the top level -- profile.php, teams.php, etc.
That script then requires a file in page/whatever.php which does presentation 
(generates HTML.)
Functionality/utility modules also live in the top level. There is no easy way to 
tell a utility from a top-level page, except for the files they require.
Also, in the page directory, there is a header.php module which emits the standard 
page header.
Someone "accidentally" hitting the wrong top-level script should be safe, as there 
is no state-modifying code in global scope in the utility modules. 

Communication between application logic (POST handlers etc) and presentation (for 
error messages etc) is done using globals named after the page -- $profile_error, 
etc. Other globals used in the processing are prefixed with an underscore.

The presentation uses no JavaScript, and basic CSS and HTML, although I'm sure 
some CSS3 and HTML5 has snuck in there (hard to avoid, really :-)

Once the data structure is proper, it may be a good idea to break out the 
application logic and view generation into separate classes that are demand 
loaded by a single top-level entry point (this will require mod_rewrite or 
similar.) Also, putting utilities into a subdirectory might organize it better.
