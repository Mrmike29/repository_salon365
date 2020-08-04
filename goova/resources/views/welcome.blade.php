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
            </div>
    	</div>
    	@include('includes.footer')
    </body>
</html>