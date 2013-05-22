<?php

    /* ====================================================================
    *
    *                             PHP Setup Wizard
    *                              by Thorsteinn
    *                               April 2010
    *
    *                          -= LAUNCH INSTALLER =-
    *
    *  ---------------------------------------------------------------
    *  WHAT DOES THIS CODE DO?
    *  ---------------------------------------------------------------
    *  Put this code in the "index.php" of your personal script to
    *  launch the installer. Make sure you have edited configuration
	*  and mask files before running the installation
    *
    *  Get more information about these files and configuration in the
    *  documentation that came with the installer. 
	*
	*  The constants below start with INST_ to prevent collision with
	*  your own constants or the framework you are using.
    *
    *
    *  ---------------------------------------------------------------
    *  DEFINE INSTALLATION CONSTANTS
    *  ---------------------------------------------------------------
    *  INST_RUNSCRIPT  - Get the name of the executing script
    *  INST_BASEDIR    - The path to the directory of THIS file
    *  INST_RUNFOLDER  - The folder that will contain the actual installer
	*  INST_RUNINSTALL - The installer script to launch
    */
    
    define('INST_RUNSCRIPT', pathinfo(__FILE__, PATHINFO_BASENAME));
    define('INST_BASEDIR',	 str_replace(INST_RUNSCRIPT, '', __FILE__));
    define('INST_RUNFOLDER', 'installer/');
	define('INST_RUNINSTALL', 'installer.php');
    if (is_dir(INST_BASEDIR.INST_RUNFOLDER) && 
		is_readable(INST_BASEDIR.INST_RUNFOLDER.INST_RUNINSTALL))
        require(INST_BASEDIR.INST_RUNFOLDER.INST_RUNINSTALL);
                 
    /* ================================================================= */
?>


<h1>Your PHP script starts here!</h1>


