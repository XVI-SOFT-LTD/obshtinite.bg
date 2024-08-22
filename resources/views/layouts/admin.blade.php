<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('settings.admin_title') }}</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
        <link href="{{ asset('css/switchery.css') }}" rel="stylesheet">
        <link href="{{ asset('css/icheck.css') }}" rel="stylesheet">
        <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet">

        <link href="{{ asset('css/gentelella.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom_admin.css') }}" rel="stylesheet">

        @stack('css')
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i>
                                <span>{{ env('APP_NAME') }}</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Добре дошъл,</span>
                                <h2>{{ auth()->user()->name }}</h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />

                        <!-- sidebar menu -->
                        @include('admin.partials._sidebar')
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('images/img.jpg') }}" alt="">{{ auth()->user()->name }}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out pull-right"></i>
                                                Изход
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                @include('admin.partials._messages')

                                @includeWhen(isset($breadcrumbs), 'admin.partials._breadcrumbs')

                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>{!! $pageTitle !!}</h2>
                                        {{-- @php
                                            $action = app('request')->route()->getAction();
                                            $controller = class_basename($action['controller']);
                                            [$controller, $method] = explode('@', $controller);
                                        @endphp
                                        @if ($method == 'create' || $method == 'edit')
                                            <div class="pull-right">
                                                <a href="{{ route($routes . '.index') }}" class="btn btn-default">Отказ</a>
                                                <button id="submit" type="submit" class="btn btn-success">Запази</button>
                                            </div>
                                        @endif --}}
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        &copy; Copyright 2023 - {{ date('Y') }} - Administration generated by
                        <a href="https://xvi-soft.com" target="_blank">XVI - SOFT LTD</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>

            <div id="modal_wrapper"></div>
        </div>


        <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/fastclick.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/nprogress.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/icheck.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/switchery.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/moment.bg.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/datetimepicker.js') }}" type="text/javascript"></script>

        <!-- tinymce -->
        <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ asset('js/gentelella.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>

        <script type="text/javascript" src="{{ asset('js/tinymce/init.js') }}"></script>

        @stack('scripts')

        @stack('js-init')
    </body>

</html>
