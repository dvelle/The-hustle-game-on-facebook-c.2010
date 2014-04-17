<?php
  # Filename: libs.inc.php

  # the exact path is defined.
  $fixpath = dirname(__FILE__);

  # changes this value according to your uploaded smarty distribution.
  # don't forget to add trailing back slash
  # change 'username' to your username on web hosting account
  define ("SMARTY_DIR", "../smarty/");

  require_once (SMARTY_DIR."Smarty.class.php");
  $smarty = new Smarty;
  $smarty->compile_dir = "$fixpath/compile";
  $smarty->template_dir = "$fixpath/html";
?> 