<?php
 include 'app_config.php';
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>
      <?= $app_name ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="shortcut icon" type="image/x-icon" href="views/homepage/src/mdvk.ico" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,400italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="//use.typekit.net/bln8hqn.js"></script>
    <style type="text/css">
      img.wp-smiley,
      img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 .07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
      }
    </style>
    <link rel='stylesheet' id='all-css-0-1' href='views/homepage/src/my.css' type='text/css' media='all' />
    <script type='text/javascript' src='views/homepage/src/jquery.js'></script>
    <style type="text/css">
      .recentcomments a {
        display: inline !important;
        padding: 0 !important;
        margin: 0 !important;
      }

      table.recentcommentsavatartop img.avatar,
      table.recentcommentsavatarend img.avatar {
        border: 0px;
        margin: 0;
      }

      table.recentcommentsavatartop a,
      table.recentcommentsavatarend a {
        border: 0px !important;
        background-color: transparent !important;
      }

      td.recentcommentsavatarend,
      td.recentcommentsavatartop {
        padding: 0px 0px 1px 0px;
        margin: 0px;
      }

      td.recentcommentstextend {
        border: none !important;
        padding: 0px 0px 2px 10px;
      }

      .rtl td.recentcommentstextend {
        padding: 0px 10px 2px 0px;
      }

      td.recentcommentstexttop {
        border: none;
        padding: 0px 0px 0px 10px;
      }

      .rtl td.recentcommentstexttop {
        padding: 0px 10px 0px 0px;
      }
    </style>
  </head>
  <!-- TOP -->

  <body class="home page-template page-template-templates page-template-front-page page-template-templatesfront-page-php page page-id-90 mp6 customizer-styles-applied group-blog highlander-enabled highlander-light">
    <div id="page" class="site container_12">
      <header id="masthead" class="site-header row" role="banner">
        <div class="site-title">
          <a href="<?= $base_url;?>" title="MDVK" rel="home">
            <h1>
              <div id="logo">
                <span></span>
              </div>
              <?= $app_name?>
            </h1>
          </a>
        </div>

        <!-- MENU -->
        <nav role="navigation" class="site-navigation main-navigation">
          <div class="menu-actions-container">
            <ul id="menu-actions" class="menu">
              <li id="menu-item-310" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-310">
                <a href="<?= $base_url;?>login">Login</a>
              </li>
              <li id="menu-item-596" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-596">
                <a href="<?= $base_url;?>register">Register</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>


      <!--  CONTENT  -->
      <div id="main" class="site-main">
        <div id="main" class="site-main-gradient">
          <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
              <article id="post-90" class="post-90 page type-page status-publish hentry">
                <div class="content entry-content">
                  <div id="homepage-baner">
                    <div class="row">
                      <div class="welcome-text">
                        <div class="col_10 push_1">
                          <h1>Teach More. Learn More.</h1>
                        </div>
                        <div class="push_2 col_8">
                          <p>Temukan konten pendidikan terbaik (sumber pendidikan gratis atau berbayar) dari seluruh web.</p>
                        </div>
                      </div>
                    </div>

                    

                    </div>

                    <!-- .CONTENT -->
              </article>


              <!-- FOOTER AREA -->
              <!-- #main .site-main -->
              <footer id="colophon" class="site-footer row" role="contentinfo">
                <div class="site-info col_3">
                  <?php echo $cpr;?>
                  <a href="https://api.whatsapp.com/send?phone=6285217087944&text=hi kaka adit !">
                    <?php echo $app_name;?>
                  </a>
                </div>
                <!-- .site-info -->
                <nav role="navigation" class="site-navigation main-navigation col_9">
                  <div class="menu-pages-container">
                    <ul id="menu-pages" class="menu">
                      <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-122">
                        <a href="#">
                          <b>Back to Top</b>
                        </a>
                      </li>
                    </ul>
                  </div>
                </nav>
                <!-- .site-navigation .main-navigation -->
              </footer>
              <!-- #colophon .site-footer -->
              </div>
              <!-- #page .hfeed .site -->
              <!--  -->
              <script type='text/javascript' src='https://s1.wp.com/wp-content/mu-plugins/gravatar-hovercards/wpgroho.js?m=1380573781h'></script>

  </body>

  </html>