<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">

		<div class="main-wrapper" style="min-height: 600px">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
            <div id="main-content">
    		    @include('includes.header')

                <section class="mb-40">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-title">
                                    <h3 class="mb-0">Welcome - InfixEdu | Super admin</h3>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Student</h3>
                                                <p class="mb-0">Total Students</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                38
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Teachers</h3>
                                                <p class="mb-0">Total Teachers</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                4
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Parents</h3>
                                                <p class="mb-0">Total Parents</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                38
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a href="#" class="d-block">
                                    <div class="white-box single-summery">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h3>Staffs</h3>
                                                <p class="mb-0">Total Staffs</p>
                                            </div>
                                            <h1 class="gradient-color2">
                                                6

                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="" id="incomeExpenseDiv">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-8 col-md-9 col-8">
                                <div class="main-title">
                                    <h3 class="mb-30"> Income and Expenses for Jul 2020 </h3>
                                </div>
                            </div>
                            <div class="offset-lg-2 col-lg-2 text-right col-md-3 col-4">
                                <button type="button" class="primary-btn small tr-bg icon-only" id="barChartBtn">
                                    <span class="pr ti-move"></span>
                                </button>

                                <button type="button" class="primary-btn small fix-gr-bg icon-only ml-10" id="barChartBtnRemovetn">
                                    <span class="pr ti-close"></span>
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <div class="white-box" id="barChartDiv">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>$16,326</h1>
                                                <p>Total Income</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>$119,263</h1>
                                                <p>Total Expenses</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>$-102,937</h1>
                                                <p>Total Profit</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-6">
                                            <div class="text-center">
                                                <h1>$16,326</h1>
                                                <p>Total Revenue</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="commonBarChart" style="height: 350px; position: relative;"><svg height="350" version="1.1" width="989" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.799988px; top: -0.5px;"><desc>Created with RaphaÃ«l 2.1.0</desc><defs></defs><text style="text-anchor: end; font: 12px &quot;Poppins&quot;, sans-serif;" x="45.016666412353516" y="308" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal"><tspan dy="4">0</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M57.516666412353516,308H964.2" stroke-width="0.5"></path><text style="text-anchor: end; font: 12px &quot;Poppins&quot;, sans-serif;" x="45.016666412353516" y="237.25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal"><tspan dy="4">1,250</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M57.516666412353516,237.25H964.2" stroke-width="0.5"></path><text style="text-anchor: end; font: 12px &quot;Poppins&quot;, sans-serif;" x="45.016666412353516" y="166.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal"><tspan dy="4">2,500</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M57.516666412353516,166.5H964.2" stroke-width="0.5"></path><text style="text-anchor: end; font: 12px &quot;Poppins&quot;, sans-serif;" x="45.016666412353516" y="95.75" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal"><tspan dy="4">3,750</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M57.516666412353516,95.75H964.2" stroke-width="0.5"></path><text style="text-anchor: end; font: 12px &quot;Poppins&quot;, sans-serif;" x="45.016666412353516" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal"><tspan dy="4">5,000</tspan></text><path style="" fill="none" stroke="#aaaaaa" d="M57.516666412353516,25H964.2" stroke-width="0.5"></path><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="947.4095678965251" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">27</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="880.2478394826254" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">25</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="813.0861110687256" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">23</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="745.9243826548259" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">21</tspan></text><text style="text-anchor: middle; font: 12px ''Poppins&quot;, sans-serif;" x="678.7626542409262" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">19</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="611.6009258270265" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">17</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="544.4391974131267" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">15</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="477.27746899922687" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">13</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="410.11574058532716" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">11</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="342.95401217142745" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">09</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="275.7922837575277" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">07</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="208.63055534362795" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">05</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="141.4688269297282" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">03</tspan></text><text style="text-anchor: middle; font: 12px &quot;Poppins&quot;, sans-serif;" x="74.30709851582844" y="320.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#415094" font-size="12px" font-family="&quot;Poppins&quot;, sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4">01</tspan></text><rect x="69.26996888478597" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="76.30709851582844" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="102.85083309173584" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="109.88796272277831" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="136.43169729868572" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="143.4688269297282" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="170.0125615056356" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="177.0496911366781" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="203.59342571258546" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="210.63055534362795" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="237.1742899195353" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="244.2114195505778" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="270.7551541264852" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="277.7922837575277" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="304.33601833343505" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="311.37314796447754" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="337.9168825403849" y="296.68" width="3.03712963104248" height="11.319999999999993" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="344.9540121714274" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="371.49774674733476" y="275.5116" width="3.03712963104248" height="32.48840000000001" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="378.53487637837725" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="405.0786109542846" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="412.1157405853271" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="438.6594751612345" y="289.6616" width="3.03712963104248" height="18.33839999999998" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="445.696604792277" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="472.2403393681844" y="291.02" width="3.03712963104248" height="16.980000000000018" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="479.27746899922687" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="505.82120357513423" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="512.8583332061767" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="539.4020677820841" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="546.4391974131266" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="572.982931989034" y="291.02" width="3.03712963104248" height="16.980000000000018" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="580.0200616200765" y="299.51" width="3.03712963104248" height="8.490000000000009" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="606.5637961959839" y="296.68" width="3.03712963104248" height="11.319999999999993" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="613.6009258270263" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="640.1446604029337" y="255.4186" width="3.03712963104248" height="52.5814" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="647.1817900339762" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="673.7255246098836" y="158.6892" width="3.03712963104248" height="149.3108" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="680.762654240926" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="707.3063888168334" y="245.74" width="3.03712963104248" height="62.25999999999999" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="714.3435184478759" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="740.8872530237833" y="75.94" width="3.03712963104248" height="232.06" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="747.9243826548258" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="774.4681172307332" y="251.4" width="3.03712963104248" height="56.599999999999994" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="781.5052468617757" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="808.0489814376831" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="815.0861110687256" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="841.629845644633" y="44.187400000000025" width="3.03712963104248" height="263.8126" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="848.6669752756754" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="875.2107098515828" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="882.2478394826253" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="908.7915740585327" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="915.8287036895751" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="942.3724382654825" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#8a33f8" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect><rect x="949.409567896525" y="308" width="3.03712963104248" height="0" r="0" rx="0" ry="0" fill="#f25278" stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect></svg><div class="morris-hover morris-default-style" style="left: 909.351px; top: 127px;"><div class="morris-hover-row-label">27</div><div class="morris-hover-point" style="color: #8a33f8">
                                                        Income:
                                                        0
                                                    </div><div class="morris-hover-point" style="color: #f25278">
                                                        Expense:
                                                        0
                                                    </div></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    	</div>

    	@include('includes.footer')
    </body>
</html>
