<nav class="navbar navbar-expand-lg up_navbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="up_dash_menu">
                    <button type="button" id="sidebarCollapse" class="btn d-lg-none nav_icon">
                        <i class="ti-more"></i>
                    </button>
                    <ul class="nav navbar-nav mr-auto search-bar">
                        <li class="">
                            <div class="input-group" id="serching">
                                <span>
                                    <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                                </span>
                                <input type="text" class="form-control primary-input input-left-icon" placeholder="Search" id="search" onkeyup="showResult(this.value)">
                                <span class="focus-border"></span>
                            </div>
                            <div id="livesearch" style="display: none;"></div>
                        </li>
                    </ul>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto nav_icon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="client_thumb_btn"></div>
                        <img class="client_img" src="https://media-exp1.licdn.com/dms/image/C560BAQHMnA03XDdf3w/company-logo_200_200/0?e=2159024400&v=beta&t=C7KMOtnrJwGrMXmgIk2u1B8a7VRfgxMwXng9cdP9kZk" alt="">
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">
                        
                        <style>
                            .nice-select.open .list { min-width: 200px;  left: 0;  padding: 5px; }
                            .nice-select .nice-select-search { min-width: 190px; }
                        </style>
                        
                        <!-- Start Right Navbar -->
                        <ul class="nav navbar-nav right-navbar">
                            
                            <li class="nav-item setting-area">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="rounded-circle" src="https://media-exp1.licdn.com/dms/image/C560BAQHMnA03XDdf3w/company-logo_200_200/0?e=2159024400&v=beta&t=C7KMOtnrJwGrMXmgIk2u1B8a7VRfgxMwXng9cdP9kZk" alt="">
                                    </button>
                                    <div class="dropdown-menu profile-box">
                                        <div class="white-box">
                                            <a class="dropdown-item" href="#">
                                                <div class="">
                                                    <div class="d-flex">
                                                        <img class="client_img" src="https://media-exp1.licdn.com/dms/image/C560BAQHMnA03XDdf3w/company-logo_200_200/0?e=2159024400&v=beta&t=C7KMOtnrJwGrMXmgIk2u1B8a7VRfgxMwXng9cdP9kZk " alt="">
                                                        <div class="d-flex ml-10">
                                                            <div class="">
                                                                <h5 class="name text-uppercase"><?php echo e(Auth::user()->name); ?> <?php echo e(Auth::user()->last_name); ?></h5>
                                                                <p class="message"><?php echo e(Auth::user()->email); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="view-staff/1">
                                                        <span class="ti-user"></span>
                                                        view profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="change-password">
                                                        <span class="ti-key"></span>
                                                        Password
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <span class="ti-unlock"></span>
                                                        logout
                                                    </a>
                                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- End Right Navbar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="sidebar-colors">
    <div class="toggle"></div>
    <div class="scroll">
        <div class="templates-header">
            <h2>Temas</h2>
        </div>
        <table>
            <tbody>
                <tr>
                    <td><a class="template template-orange" onclick="changeColor('orange')"></a></td>
                    <td><a class="template template-blue" onclick="changeColor('blue')"></a></td>
                </tr>
                <tr>
                    <td><a class="template template-purple" onclick="changeColor('purple')"></a></td>
                    <td><a class="template template-red" onclick="changeColor('red')"></a></td>
                </tr>
                <tr>
                    <td><a class="template template-green" onclick="changeColor('green')"></a></td>
                    <td><a class="template template-cyan" onclick="changeColor('cyan')"></a></td>
                </tr>
                <tr>
                    <td><a class="template template-columbia" onclick="changeColor('columbia')"></a></td>
                    <td><a class="template template-grey" onclick="changeColor('grey')"></a></td>
                </tr>
                <tr>
                    <td><a class="template template-mixed" onclick="changeColor('mixed')"></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\Users\Desarrollo1\Desktop\Goova\repository_salon365\goova\resources\views/includes/header.blade.php ENDPATH**/ ?>