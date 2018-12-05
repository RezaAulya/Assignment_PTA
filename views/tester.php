
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Media</title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link rel="SHORTCUT ICON" href="http://127.0.0.1/school/uploads/images/site.png" />

        <link rel="stylesheet" href="http://127.0.0.1/school/assets/pace/pace.css">

        <script type="text/javascript" src="http://127.0.0.1/school/assets/inilabs/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="http://127.0.0.1/school/assets/slimScroll/jquery.slimscroll.min.js"></script> -->

        <script type="text/javascript" src="http://127.0.0.1/school/assets/toastr/toastr.min.js"></script>


        <link href="http://127.0.0.1/school/assets/bootstrap/bootstrap.min.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/fonts/font-awesome.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/fonts/icomoon.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/datatables/dataTables.bootstrap.css" rel="stylesheet">

        <link id="headStyleCSSLink" href="http://127.0.0.1/school/assets/inilabs/themes/default/style.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/inilabs/hidetable.css" rel="stylesheet">

        <link id="headInilabsCSSLink" href="http://127.0.0.1/school/assets/inilabs/themes/default/inilabs.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/inilabs/responsive.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/toastr/toastr.min.css" rel="stylesheet">

        <link href="http://127.0.0.1/school/assets/inilabs/mailandmedia.css" rel="stylesheet">

        <link rel="stylesheet" href="http://127.0.0.1/school/assets/datatables/buttons.dataTables.min.css" >

        <link rel="stylesheet" href="http://127.0.0.1/school/assets/inilabs/combined.css" >

        
        <script type="text/javascript">
          $(window).load(function() {
            $(".se-pre-con").fadeOut("slow");;
          });
        </script>
    </head>
    <body class="skin-blue fuelux">
        <div class="se-pre-con"></div>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="http://127.0.0.1/school/dashboard/index" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                SMS            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>


                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        



                        <!-- Site Start -->
                        <li class="dropdown notifications-menu">
                            <a target="_blank" href="http://127.0.0.1/school/frontend/page" class="dropdown-toggle" data-toggle="tooltip" title="Visit Site" data-placement="bottom">
                                <i class="fa fa-globe"></i>
                            </a>
                        </li>
                        <!-- Site Close -->


                        <!-- School Year: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar-plus-o"></i><span class='label label-success'><lable class='alert-image'>1</lable></span></a><ul class="dropdown-menu"><li class="header">You have 1 year</li><li><ul class="menu"><li><a href="http://127.0.0.1/school/schoolyear/toggleschoolyear/1"><h4>2017-2018 - (Default) <i class='glyphicon glyphicon-ok'></i></h4></a></li></ul></li></ul></li>
                        <!-- Messages: style can be found in dropdown.less-->
                                                <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                                            </a>
                                                    </li>
                                                                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="language-img" src="http://127.0.0.1/school/uploads/language_image/english.png" 
                                /> 
                                <span class="label label-warning">15</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"> Language</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li class="language" id="arabic">
                                            <a href="http://127.0.0.1/school/language/index/arabic">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/arabic.png"/>
                                                </div>
                                                <h4>
                                                    Arabic
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="bengali">
                                            <a href="http://127.0.0.1/school/language/index/bengali">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/bengali.png"/>
                                                </div>
                                                <h4>
                                                    Bengali
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="chinese">
                                            <a href="http://127.0.0.1/school/language/index/chinese">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/chinese.png"/>
                                                </div>
                                                <h4>
                                                    Chinese
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="english">
                                            <a href="http://127.0.0.1/school/language/index/english">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/english.png"/>
                                                </div>
                                                <h4>
                                                    English
                                                     <i class='glyphicon glyphicon-ok'></i>                                                </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="french">
                                            <a href="http://127.0.0.1/school/language/index/french">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/french.png"/>
                                                </div>
                                                <h4>
                                                    French
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="german">
                                            <a href="http://127.0.0.1/school/language/index/german">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/german.png"/>
                                                </div>
                                                <h4>
                                                    German
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="hindi">
                                            <a href="http://127.0.0.1/school/language/index/hindi">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/hindi.png"/>
                                                </div>
                                                <h4>
                                                    Hindi
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="indonesian">
                                            <a href="http://127.0.0.1/school/language/index/indonesian">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/indonesian.png"/>
                                                </div>
                                                <h4>
                                                    Indonesian
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="italian">
                                            <a href="http://127.0.0.1/school/language/index/italian">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/italian.png"/>
                                                </div>
                                                <h4>
                                                    Italian
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="portuguese">
                                            <a href="http://127.0.0.1/school/language/index/portuguese">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/portuguese.png"/>
                                                </div>
                                                <h4>
                                                    Portuguese
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="romanian">
                                            <a href="http://127.0.0.1/school/language/index/romanian">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/romanian.png"/>
                                                </div>
                                                <h4>
                                                    Romanian
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="russian">
                                            <a href="http://127.0.0.1/school/language/index/russian">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/russian.png"/>
                                                </div>
                                                <h4>
                                                    Russian
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="spanish">
                                            <a href="http://127.0.0.1/school/language/index/spanish">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/spanish.png"/>
                                                </div>
                                                <h4>
                                                    Spanish
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="thai">
                                            <a href="http://127.0.0.1/school/language/index/thai">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/thai.png"/>
                                                </div>
                                                <h4>
                                                    Thai
                                                                                                    </h4>
                                            </a>
                                        </li>

                                        <li class="language" id="turkish">
                                            <a href="http://127.0.0.1/school/language/index/turkish">
                                                <div class="pull-left">
                                                    <img src="http://127.0.0.1/school/uploads/language_image/turkish.png"/>
                                                </div>
                                                <h4>
                                                    Turkish
                                                                                                    </h4>
                                            </a>
                                        </li>
             
                                    </ul>
                                </li>
                                <li class="footer"></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                                                
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="http://127.0.0.1/school/uploads/images/default.png" class="user-logo" alt="" />
                                
                                <span>
                                    Aditya Prat..                                    <i class="caret"></i>
                                </span>   
                            </a>

                            <ul class="dropdown-menu">

                                <!-- Menu Body -->

                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="http://127.0.0.1/school/profile/index">
                                            <div><i class="fa fa-briefcase"></i></div>
                                            Profile 
                                        </a>

                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="http://127.0.0.1/school/signin/cpassword">
                                            <div><i class="fa fa-lock"></i></div>
                                            Password 
                                        </a>
                                    </div>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="text-center">
                                        <a href="http://127.0.0.1/school/signin/signout">
                                            <div><i class="fa fa-power-off"></i></div>
                                            Log out 
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>   <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img style="display:block" src="http://127.0.0.1/school/uploads/images/default.png" class="img-circle" alt="" />
                        </div>

                        <div class="pull-left info">
                            <p>Aditya Prat..</p>                            <a href="http://127.0.0.1/school/profile/index">
                                <i class="fa fa-hand-o-right color-green"></i>
                                Admin                            </a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                                        <ul class="sidebar-menu">
                        <li class=""><a href="http://127.0.0.1/school/dashboard"><i class="fa fa-laptop"></i><span>Dashboard</span> </a></li><li class=""><a href="http://127.0.0.1/school/student"><i class="fa icon-student"></i><span>Student</span> </a></li><li class=""><a href="http://127.0.0.1/school/parents"><i class="fa fa-user"></i><span>Parents</span> </a></li><li class=""><a href="http://127.0.0.1/school/teacher"><i class="fa icon-teacher"></i><span>Teacher</span> </a></li><li class=""><a href="http://127.0.0.1/school/user"><i class="fa fa-users"></i><span>User</span> </a></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-academicmain"></i><span>Academic</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/classes"><i class="fa fa-sitemap"></i><span>Class</span> </a></li><li class=""><a href="http://127.0.0.1/school/subject"><i class="fa icon-subject"></i><span>Subject</span> </a></li><li class=""><a href="http://127.0.0.1/school/section"><i class="fa fa-star"></i><span>Section</span> </a></li><li class=""><a href="http://127.0.0.1/school/syllabus"><i class="fa icon-syllabus"></i><span>Syllabus</span> </a></li><li class=""><a href="http://127.0.0.1/school/assignment"><i class="fa icon-assignment"></i><span>Assignment</span> </a></li><li class=""><a href="http://127.0.0.1/school/routine"><i class="fa icon-routine"></i><span>Routine</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-attendance"></i><span>Attendance</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/sattendance"><i class="fa icon-sattendance"></i><span>Student Attendance</span> </a></li><li class=""><a href="http://127.0.0.1/school/tattendance"><i class="fa icon-tattendance"></i><span>Teacher Attendance</span> </a></li><li class=""><a href="http://127.0.0.1/school/uattendance"><i class="fa fa-user-secret"></i><span>User Attendance</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-exam"></i><span>Exam</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/exam"><i class="fa fa-pencil"></i><span>Exam</span> </a></li><li class=""><a href="http://127.0.0.1/school/examschedule"><i class="fa fa-puzzle-piece"></i><span>Exam Schedule</span> </a></li><li class=""><a href="http://127.0.0.1/school/grade"><i class="fa fa-signal"></i><span>Grade</span> </a></li><li class=""><a href="http://127.0.0.1/school/eattendance"><i class="fa icon-eattendance"></i><span>Exam Attendance</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-markmain"></i><span>Mark</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/mark"><i class="fa fa-flask"></i><span>Mark</span> </a></li><li class=""><a href="http://127.0.0.1/school/markpercentage"><i class="fa icon-markpercentage"></i><span>Mark Percentage</span> </a></li><li class=""><a href="http://127.0.0.1/school/promotion"><i class="fa icon-promotion"></i><span>Promotion</span> </a></li></ul></li><li class=""><a href="http://127.0.0.1/school/conversation"><i class="fa fa-envelope"></i><span>Message</span> </a></li><li class="active"><a href="http://127.0.0.1/school/media"><i class="fa fa-film"></i><span>Media</span> </a></li><li class=""><a href="http://127.0.0.1/school/mailandsms"><i class="fa icon-mailandsms"></i><span>Mail / SMS</span> </a></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-graduation-cap"></i><span>Online Exam</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/question_group"><i class="fa fa-question-circle"></i><span>Question Group</span> </a></li><li class=""><a href="http://127.0.0.1/school/question_level"><i class="fa fa-level-up"></i><span>Question Level</span> </a></li><li class=""><a href="http://127.0.0.1/school/question_bank"><i class="fa fa-qrcode"></i><span>Question Bank</span> </a></li><li class=""><a href="http://127.0.0.1/school/online_exam"><i class="fa fa-slideshare"></i><span>Online Exam</span> </a></li><li class=""><a href="http://127.0.0.1/school/instruction"><i class="fa fa-map-signs"></i><span>Instruction</span> </a></li><li class=""><a href="http://127.0.0.1/school/take_exam"><i class="fa fa-user-secret"></i><span>Take Exam</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-usd"></i><span>Payroll</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/salary_template"><i class="fa fa-calculator"></i><span>Salary Template</span> </a></li><li class=""><a href="http://127.0.0.1/school/hourly_template"><i class="fa fa fa-clock-o"></i><span>Hourly Template</span> </a></li><li class=""><a href="http://127.0.0.1/school/manage_salary"><i class="fa fa-beer"></i><span>Manage Salary</span> </a></li><li class=""><a href="http://127.0.0.1/school/make_payment"><i class="fa fa-money"></i><span>Make Payment</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-archive"></i><span>Asset Management</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/vendor"><i class="fa fa-rss"></i><span>Vendor</span> </a></li><li class=""><a href="http://127.0.0.1/school/location"><i class="fa fa-newspaper-o"></i><span>Location</span> </a></li><li class=""><a href="http://127.0.0.1/school/asset_category"><i class="fa fa-life-ring"></i><span>Asset Category</span> </a></li><li class=""><a href="http://127.0.0.1/school/asset"><i class="fa fa-fax"></i><span>Asset</span> </a></li><li class=""><a href="http://127.0.0.1/school/asset_assignment"><i class="fa fa-plug"></i><span>Asset Assignment</span> </a></li><li class=""><a href="http://127.0.0.1/school/purchase"><i class="fa fa-cart-plus"></i><span>Purchase</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-child"></i><span>Child</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/activitiescategory"><i class="fa fa-pagelines"></i><span>Activities Category</span> </a></li><li class=""><a href="http://127.0.0.1/school/activities"><i class="fa fa-fighter-jet"></i><span>Activities</span> </a></li><li class=""><a href="http://127.0.0.1/school/childcare"><i class="fa fa-wheelchair"></i><span>Child Care</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-library"></i><span>Library</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/lmember"><i class="fa icon-member"></i><span>Member</span> </a></li><li class=""><a href="http://127.0.0.1/school/book"><i class="fa icon-lbooks"></i><span>Books</span> </a></li><li class=""><a href="http://127.0.0.1/school/issue"><i class="fa icon-issue"></i><span>Issue</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-bus"></i><span>Transport</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/transport"><i class="fa icon-sbus"></i><span>Transport</span> </a></li><li class=""><a href="http://127.0.0.1/school/tmember"><i class="fa icon-member"></i><span>Member</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-hhostel"></i><span>Hostel</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/hostel"><i class="fa icon-hostel"></i><span>Hostel</span> </a></li><li class=""><a href="http://127.0.0.1/school/category"><i class="fa fa-leaf"></i><span>Category</span> </a></li><li class=""><a href="http://127.0.0.1/school/hmember"><i class="fa icon-member"></i><span>Member</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-account"></i><span>Account</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/feetypes"><i class="fa icon-feetypes"></i><span>Fee Types</span> </a></li><li class=""><a href="http://127.0.0.1/school/invoice"><i class="fa icon-invoice"></i><span>Invoice</span> </a></li><li class=""><a href="http://127.0.0.1/school/paymenthistory"><i class="fa icon-payment"></i><span>Payment History</span> </a></li><li class=""><a href="http://127.0.0.1/school/expense"><i class="fa icon-expense"></i><span>Expense</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-noticemain"></i><span>Announcement</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/notice"><i class="fa fa-calendar"></i><span>Notice</span> </a></li><li class=""><a href="http://127.0.0.1/school/event"><i class="fa fa-calendar-check-o"></i><span>Event</span> </a></li><li class=""><a href="http://127.0.0.1/school/holiday"><i class="fa icon-holiday"></i><span>Holiday</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-clipboard"></i><span>Report</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/report/classreport"><i class="fa icon-classreport"></i><span>Class Report</span> </a></li><li class=""><a href="http://127.0.0.1/school/report/attendancereport"><i class="fa icon-attendancereport"></i><span>Attendance Report</span> </a></li><li class=""><a href="http://127.0.0.1/school/report/studentreport"><i class="fa icon-studentreport"></i><span>Student Report</span> </a></li><li class=""><a href="http://127.0.0.1/school/report/certificate"><i class="fa fa-diamond"></i><span>Certificate</span> </a></li></ul></li><li class=""><a href="http://127.0.0.1/school/visitorinfo"><i class="fa icon-visitorinfo"></i><span>Visitor Information</span> </a></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa icon-administrator"></i><span>Administrator</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/schoolyear"><i class="fa fa fa-calendar-plus-o"></i><span>Academic Year</span> </a></li><li class=""><a href="http://127.0.0.1/school/studentgroup"><i class="fa fa-object-group"></i><span>Student Group</span> </a></li><li class=""><a href="http://127.0.0.1/school/complain"><i class="fa fa-commenting"></i><span>Complain</span> </a></li><li class=""><a href="http://127.0.0.1/school/certificate_template"><i class="fa fa-certificate"></i><span>Certificate Template</span> </a></li><li class=""><a href="http://127.0.0.1/school/systemadmin"><i class="fa icon-systemadmin"></i><span>System Admin</span> </a></li><li class=""><a href="http://127.0.0.1/school/resetpassword"><i class="fa icon-reset_password"></i><span>Reset Password</span> </a></li><li class=""><a href="http://127.0.0.1/school/mailandsmstemplate"><i class="fa icon-template"></i><span>Mail / SMS Template</span> </a></li><li class=""><a href="http://127.0.0.1/school/bulkimport"><i class="fa fa-upload"></i><span>Import</span> </a></li><li class=""><a href="http://127.0.0.1/school/backup"><i class="fa fa-download"></i><span>Backup</span> </a></li><li class=""><a href="http://127.0.0.1/school/usertype"><i class="fa icon-role"></i><span>Role</span> </a></li><li class=""><a href="http://127.0.0.1/school/permission"><i class="fa icon-permission"></i><span>Permission</span> </a></li><li class=""><a href="http://127.0.0.1/school/update"><i class="fa fa-refresh"></i><span>Update</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-gavel"></i><span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/setting"><i class="fa fa-gears"></i><span>General Setting</span> </a></li><li class=""><a href="http://127.0.0.1/school/paymentsettings"><i class="fa icon-paymentsettings"></i><span>Payment Settings</span> </a></li><li class=""><a href="http://127.0.0.1/school/smssettings"><i class="fa fa-wrench"></i><span>SMS Settings</span> </a></li></ul></li><li class="treeview "><a href="http://127.0.0.1/school/#"><i class="fa fa-home"></i><span>Frontend</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu"><li class=""><a href="http://127.0.0.1/school/pages"><i class="fa fa-connectdevelop"></i><span>Pages</span> </a></li><li class=""><a href="http://127.0.0.1/school/frontend_setting"><i class="fa fa-asterisk"></i><span>Frontend Settings</span> </a></li></ul></li>
                    </ul>

                </section>
                <!-- /.sidebar -->
            </aside>
        <aside class="right-side">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-film"></i> Media</h3>

       
        <ol class="breadcrumb">
            <li><a href="http://127.0.0.1/school/dashboard/index"><i class="fa fa-laptop"></i> Dashboard</a></li>
            <li class="active">Media</li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <div class="box-body">
                                        <h5 class="page-header">
                        <button class="btn-cs btn-sm-cs" data-toggle="modal" data-target="#folder"><span class="fa fa-folder"></span> Create Folder</button>                
                    </h5>
                    
                    <div class="row">
                                                <div class="col-lg-3 col-sm-12">
                            <a class="btn btn-app bg-aqua" id="media-upload" data-toggle="modal" data-target="#file_upload">
                            <i class="fa fa-plus fa-2x"></i>                        
                            </a>
                            <input id="upload_media" name="upload_media" type="file"/>
                        </div>  
                                                                                                                                                                       
                        
                                            </div>  

                </div>

            </div>
        </div>
    </div>
</div>
<!-- share modal starts here -->
<form class="form-horizontal" role="form" method="post" action="http://127.0.0.1/school/media/media_share">
    <div class="modal fade" id="share_modal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Share</h4>
            </div>
            <div class="modal-body">
                
                <input id="media_info" name="media_info" type="hidden" value="">  
                
                <div class='form-group' >                    <label for="share_with" class="col-sm-3 control-label">
                        Share with                    </label>
                    <div class="col-sm-6">
                        <select name="share_with" id="share_with" class="form-control">
                            <option value="0">Share with</option>                        
                            <option value="public">Public</option>
                            <option value="class">Class</option>
                        </select>
                    </div>
                    <span class="col-sm-4 col-sm-offset-3 control-label" id="share_with_error">
                    </span>
                </div>

                <div class='form-group' id='di'>                    <label for="classesID" class="col-sm-3 control-label">
                        Select class                    </label>
                    <div class="col-sm-6">
                        <select name="classesID" id="classesID" class="form-control">
                        </select>
                    </div>
                    <span class="col-sm-4 col-sm-offset-3 control-label" id="share_with_error">
                    </span>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal">Close</button>
                <input type="submit" id="share_files" class="btn btn-success" value="Share" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- share end here -->
<!-- folder modal starts here -->
<form class="form-horizontal" role="form" method="post">
    <div class="modal fade" id="folder">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Create Folder</h4>
            </div>
            <div class="modal-body">
                

                <div class='form-group' >                    <label for="folder_name" class="col-sm-3 control-label">
                        Folder name                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="folder_name" name="folder_name" value="" >
                    </div>
                    <span class="col-sm-4 col-sm-offset-3 control-label" id="folder_name_error">
                    </span>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal">Close</button>
                <input type="button" id="create_folder" class="btn btn-success" value="Create Folder" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- folder end here -->
<!-- file modal starts here -->
<form action="http://127.0.0.1/school/media/add" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="file_upload">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Upload media</h4>
            </div>
            <div class="modal-body">
                <div class='form-group' >
                    <label for="photo" class="col-sm-3 control-label col-xs-8 col-md-2">
                        Media                    </label>

                    <div class="col-sm-9">
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="fa fa-remove"></span>
                                    Clear                                </button>
                                <div class="btn btn-success image-preview-input">
                                    <span class="fa fa-repeat"></span>
                                    <span class="image-preview-input-title">
                                    File Browse</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif, application/pdf, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf" name="file"/>
                                </div>
                            </span>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal">Close</button>
                <input type="submit" id="upload_file" class="btn btn-success" value="Upload media" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- folder end here -->
<script type="text/javascript">
    $('#di').hide();
    $("#create_folder").click(function(){
        var folder_name = $('#folder_name').val();
        if(folder_name == "") {
            $("#folder_name_error").html("Please enter folder name").css("text-align", "left").css("color", 'red');
        } else {
            $("#folder_name_error").html("");
            $.ajax({
                type: 'POST',
                url: "http://127.0.0.1/school/media/create_folder",
                data: 'folder_name='+ folder_name,
                dataType: "html",
                success: function(data) {
                    location.reload();
                }
            });
        }
    });

    $('.share_file').click(function() {
       $('#media_info').val($(this).attr('id'));
    });

    $("#share_with").change(function() {
        var share_with = $(this).val();
        if (share_with=="class") {
            $('#di').show();
        } else {
            $('#di').hide();
        }
    });

    $("#share_with").change(function() {
        var share_with = $(this).val();
        if (share_with=="class") {
            $.ajax({
                type: 'POST',
                url: "http://127.0.0.1/school/media/classcall",
                dataType: "html",
                success: function(data) {
                   $('#classesID').html(data);
                }
            });
        } else {
            $('#classesID').html("");            
        }
    });


    $(document).on('click', '#close-preview', function(){ 
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
               $('.image-preview').popover('show');
               $('.content').css('padding-bottom', '100px');
            }, 
             function () {
               $('.image-preview').popover('hide');
               $('.content').css('padding-bottom', '20px');
            }
        );    
    });

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("File Browse"); 
        }); 
        // Create the preview image
        $(".image-preview-input input:file").change(function (){     
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200,
                overflow:'hidden'
            });      
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("File Browse");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
            }        
            reader.readAsDataURL(file);
        });  
    });    
</script>                    </div>
                </div>
            </section>
        </aside>

        <footer class="main-footer">
          	<div class="pull-right hidden-xs">
            	<b>v</b> 3.5          	</div>
          	<strong>Copyright &copy; SMS</strong>
        </footer>
        </div><!-- ./wrapper -->


        


        <!-- Bootstrap js -->
        <script type="text/javascript" src="http://127.0.0.1/school/assets/bootstrap/bootstrap.min.js"></script>
        <!-- Style js -->
        <script type="text/javascript" src="http://127.0.0.1/school/assets/inilabs/style.js"></script>

        <!-- Jquery datatable tools js -->
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/jszip.min.js"></script>
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/pdfmake.min.js"></script>
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/vfs_fonts.js"></script>
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/tools/buttons.html5.min.js"></script>
        <!-- dataTables Tools / -->
        <script type="text/javascript" src="http://127.0.0.1/school/assets/datatables/dataTables.bootstrap.js"></script>

        <script type="text/javascript" src="http://127.0.0.1/school/assets/inilabs/inilabs.js"></script>


        <!-- Jquery gritter -->
        <!-- datatable with buttons -->
        <script>
        $(document).ready(function() {
          $('#example3, #example1, #example2').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5'
              ],
              search: false
          } );
        } );
        </script>
        <!-- dataTable with buttons end -->

        <script type="text/javascript">
            $(function() {
                $("#withoutBtn").dataTable();
            });


        </script>

                
                
        <script type="text/javascript">
            $("ul.sidebar-menu li").each(function(index, value) {

                if($(this).attr('class') == 'active') {
                    $(this).parents('li').addClass('active');
                }

            });
        </script>
    </body>
</html>


