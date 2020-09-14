

<nav class="navbar navbar-expand-lg up_navbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="up_dash_menu">
                    <button type="button" id="sidebarCollapse" class="btn d-lg-none nav_icon">
                        <i class="ti-more"></i>
                    </button>
                    
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
                                                <li id="password_change">
                                                    <a href="#change">
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
<?php if($_SERVER['REQUEST_URI'] !== '/home'): ?>
    <div class="row mb-9">
        <div class="col-lg-12">
            <i class="icofont icofont-arrow-left" title="Volver" style="font-size: 25px; color: var(--g-third); cursor: pointer;"></i>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/includes/header.blade.php ENDPATH**/ ?>