

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
                        {{-- <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                            <li class="nav-item">
                                <a class="primary-btn white mr-10" href="home">Website</a>
                            </li>
                            <li class="nav-item">
                                <a class="primary-btn white mr-10" href="admin-dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="primary-btn white" href="student-report">Reports</a>
                            </li>
                        </ul> --}}
                        <style>
                            .nice-select.open .list { min-width: 200px;  left: 0;  padding: 5px; }
                            .nice-select .nice-select-search { min-width: 190px; }
                        </style>
                        {{-- <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_style" id="infix_theme_style">
                                    <option data-display="Select Style" value="0">Select Style</option>
                                    <option value="1" selected="">Default</option>
                                    <option value="2">Lawn Green</option>
                                </select>
                                <div class="nice-select niceSelect infix_theme_style" tabindex="0">
                                    <span class="current">Default</span>
                                    <div class="nice-select-search-box">
                                        <input type="text" class="nice-select-search" placeholder="Search...">
                                    </div>
                                    <ul class="list">
                                        <li data-value="0" data-display="Select Style" class="option">Select Style</li>
                                        <li data-value="1" class="option selected">Default</li>
                                        <li data-value="2" class="option">Lawn Green</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_rtl" id="infix_theme_rtl">
                                    <option data-display="Select Alignment" value="0">Select Alignment</option>
                                    <option value="2" selected="">LTL</option>
                                    <option value="1">RTL</option>
                                </select><div class="nice-select niceSelect infix_theme_rtl" tabindex="0"><span class="current">LTL</span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="Search..."></div><ul class="list"><li data-value="0" data-display="Select Alignment" class="option">Select Alignment</li><li data-value="2" class="option selected">LTL</li><li data-value="1" class="option">RTL</li></ul></div>
                            </li>
                        </ul> --}}
                        <!-- Start Right Navbar -->
                        <ul class="nav navbar-nav right-navbar">
                            {{-- <li class="nav-item">
                                <select class="niceSelect languageChange" name="languageChange" id="languageChange" style="display: none;">
                                    <option data-display="Select Language" value="0">Select Language</option>
                                    <option data-display="English" value="en" selected="">English</option>
                                    <option data-display="Español" value="es">Español</option>
                                    <option data-display="Français" value="fr">Français</option>
                                    <option data-display="العربية" value="ar">العربية</option>
                                    <option data-display="Türkçe" value="tr">Türkçe</option>
                                    <option data-display="မြန်မာစာ" value="my">မြန်မာစာ</option>
                                    <option data-display="Español" value="es">Español</option>
                                    <option data-display="中文" value="zh">中文</option>
                                    <option data-display="Français" value="fr">Français</option>
                                    <option data-display="Português" value="pt">Português</option>
                                    <option data-display="Русский" value="ru">Русский</option>
                                    <option data-display="Bahasa Indonesia" value="indo">Bahasa Indonesia</option>
                                    <option data-display="Français" value="fr">Français</option>
                                    <option data-display="فارسی" value="fa">فارسی</option>
                                    <option data-display="አማርኛ" value="am">አማርኛ</option>
                                    <option data-display="Bahasa Indonesia" value="indo">Bahasa Indonesia</option>
                                    <option data-display="Tiếng Việt" value="vi">Tiếng Việt</option>
                                    <option data-display="Italiano" value="it">Italiano</option>
                                    <option data-display="Español" value="es">Español</option>
                                    <option data-display="Türkçe" value="tr">Türkçe</option>
                                    <option data-display="Türkçe" value="tr">Türkçe</option>
                                </select>
                                <div class="nice-select niceSelect languageChange" tabindex="0">
                                    <span class="current">English</span>
                                    <div class="nice-select-search-box">
                                        <input type="text" class="nice-select-search" placeholder="Search...">
                                    </div>
                                    <ul class="list">
                                        <li data-value="0" data-display="Select Language" class="option">Select Language</li>
                                        <li data-value="en" data-display="English" class="option selected">English</li>
                                        <li data-value="es" data-display="Español" class="option">Español</li>
                                        <li data-value="fr" data-display="Français" class="option">Français</li>
                                        <li data-value="ar" data-display="العربية" class="option">العربية</li>
                                        <li data-value="tr" data-display="Türkçe" class="option">Türkçe</li>
                                        <li data-value="my" data-display="မြန်မာစာ" class="option">မြန်မာစာ</li>
                                        <li data-value="es" data-display="Español" class="option">Español</li>
                                        <li data-value="zh" data-display="中文" class="option">中文</li>
                                        <li data-value="fr" data-display="Français" class="option">Français</li>
                                        <li data-value="pt" data-display="Português" class="option">Português</li>
                                        <li data-value="ru" data-display="Русский" class="option">Русский</li>
                                        <li data-value="indo" data-display="Bahasa Indonesia" class="option">Bahasa Indonesia</li>
                                        <li data-value="fr" data-display="Français" class="option">Français</li>
                                        <li data-value="fa" data-display="فارسی" class="option">فارسی</li>
                                        <li data-value="am" data-display="አማርኛ" class="option">አማርኛ</li>
                                        <li data-value="indo" data-display="Bahasa Indonesia" class="option">Bahasa Indonesia</li>
                                        <li data-value="vi" data-display="Tiếng Việt" class="option">Tiếng Việt</li>
                                        <li data-value="it" data-display="Italiano" class="option">Italiano</li>
                                        <li data-value="es" data-display="Español" class="option">Español</li>
                                        <li data-value="tr" data-display="Türkçe" class="option">Türkçe</li>
                                        <li data-value="tr" data-display="Türkçe" class="option">Türkçe</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item notification-area  d-none d-lg-block">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="badge">0</span>
                                        <span class="flaticon-notification"></span>
                                    </button>
                                    <div class="dropdown-menu" >
                                        <div id="notifications">
                                            <div class="white-box">
                                                <div class="p-h-20">
                                                    <p class="notification">
                                                        You have <span>0 new</span>
                                                        notification
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="view/all/notification/1" class="primary-btn text-center text-uppercase mark-all-as-read">
                                            Mark All As Read
                                        </a>
                                    </div>
                                </div>
                            </li> --}}
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
                                                                <h5 class="name text-uppercase">{{Auth::user()->name}} {{Auth::user()->last_name}}</h5>
                                                                <p class="message">{{Auth::user()->email}}</p>
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
                                                        @csrf
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
