<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH.'assets/vendor/mdl/material.min.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOTPATH.'assets/MSI/custom/custom.css';?>">
    <link rel="stylesheet" href="<?php echo ROOTPATH.'assets/vendor/sweetalert2/sweetalert2.min.css';?>">
  </head>

  <body>
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">SISTEM INFORMASI PRAKTIKUM</span>
        <!-- Add spacer, to align navigation to the right -->
        <!-- Navigation. We hide it in small screens. -->
        </div>
      </header>
      <main class="mdl-layout__content">
        <div class="page-content">
          <hgroup>
            <h3>SISTEM INFORMASI PRAKTIKUM</h3>
          </hgroup>
          <?php echo form_open('Login/auth','class="admin"')?>
            <div class="group">
              <input type="text" name="username" required><span class="highlight"></span>
              <span class="bar"></span>
              <label>username</label>
            </div>
            <div class="group">
              <input type="password" name="password" required><span class="highlight"></span>
              <span class="bar"></span>
              <label>password</label>
            </div>
            <button  class="button buttonBlue" name="submit" value="submit">LOGIN
              <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>  
            </button>
            
          <?php echo form_close()?>
          <!--
          <footer>
            <a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
            <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
          </footer>-->
        </div>
      </main>
    </div> 
    <script src="<?php echo ROOTPATH.'assets/vendor/jquery/jquery-3.2.1.min.js';?>"></script>
    <script src="<?php echo ROOTPATH.'assets/vendor/mdl/material.min.js';?>"></script>
    <script src="<?php echo ROOTPATH.'assets/MSI/custom/custom.js';?>"></script>
    <script src="<?php echo ROOTPATH.'assets/vendor/sweetalert2/sweetalert2.min.js';?>"></script>
    
    <?php echo $pesan;?>
  </body>
</html>
