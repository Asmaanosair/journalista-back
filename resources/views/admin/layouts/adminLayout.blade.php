<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="{{AdminAssets()}}/image/png" sizes="16x16" href="{{AdminAssets()}}/images/favicon.png">
    <title>Material pro admin Template - The Ultimate Multipurpose admin template</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/" />
    <!-- This Page CSS -->

    <link href="{{AdminAssets()}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="{{AdminAssets()}}/dist/css/style.min.css" rel="stylesheet">
    <!-- <link href="{{asset('/css/app.css')}}" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <![endif]-->
</head>

<body>

{{--    {{! $profile =App\User::find(Auth::user()->id)}}--}}

{{--    {{!$exp_image = explode('http://localhost:8000/', $profile->image)}}--}}

{{--    {{! $image = $exp_image[1]}}--}}
    <!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{AdminAssets()}}/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{AdminAssets()}}/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{AdminAssets()}}/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{AdminAssets()}}/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto float-left">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Mega Menu -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Mega Menu -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <notification-component></notification-component>

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown">
{{--                                <img src="{{$image == 'assets_admin/images/avatar2.png' ? '/assets_admin/images/avatar2.png' : '/storage/'.$image }}" alt="user" width="30" class="profile-pic rounded-circle" />--}}
                                <img src="{{auth()->user()->image}}" alt="user" width="30" class="profile-pic rounded-circle" />
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                                <ul class="dropdown-user list-style-none">
                                    <li>
                                        <div class="dw-user-box p-3 d-flex">
{{--                                            <div class="u-img"><img src="{{$image == 'assets_admin/images/avatar2.png' ? '/assets_admin/images/avatar2.png' : '/storage/'.$image }}" alt="user" class="rounded" width="80"></div>--}}
                                            <div class="u-img"><img src="{{auth()->user()->image}}" alt="user" class="rounded" width="80"></div>
                                            <div class="u-text ml-2">
                                                <h4 class="mb-0">{{auth()->user()->name}}</h4>
                                                <p class="text-muted mb-1 font-14">{{auth()->user()->email}}</p>
                                                <a href="{{route('admin.show.profile',Auth::user()->id)}}" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                                    Profile</a>

                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="{{AdminUrl('dashboard')}}"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="{{route('admin.edit.profile',Auth::user()->id)}}"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list">
                                        <a href="{{ route('logout') }}" class="px-3 py-2" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>

                                            <i class="fa fa-power-off"></i> Logout
                                        </a></li>

                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->

                    </ul>

                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile position-relative" style="background: url({{AdminAssets()}}/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img" style="position:relative; top:30px">


{{--                        <img class="card-img-top my-image" src="{{$image == 'assets_admin/images/avatar2.png' ? '/assets_admin/images/avatar2.png' : '/storage/'.$image }}" alt="Card image cap">--}}
                        <img class="card-img-top my-image" src="{{auth()->user()->image}}" alt="Card image cap">
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text pt-1">
                        <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->name}}</a>

                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->

                <nav class="sidebar-nav">

                    <ul id="sidebarnav">


                        <li class="sidebar-item"> <a class="sidebar-link" href="{{route('admin.show.profile',Auth::user()->id)}}"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu"> البروفايل</span></a>
                        </li>
                        @if(!auth()->user()->is_organization())

                                <li class="sidebar-item"><a href="{{AdminUrl('journalists')}}" class="sidebar-link"><i class="fa fa-user"></i><span class="hide-menu"> الصحفين </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{AdminUrl('organization')}}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">المنظمات الاخباريه
                                        </span></a></li>


                                    <li class="sidebar-item">
                                        <router-link :to="{name:'category'}" class="sidebar-link"><i class="mdi mdi-newspaper"></i><span class="hide-menu"> الوسائل الاخبارية </span></router-link>
                                    </li>
                                    <li class="sidebar-item">
                                        <router-link :to="{name:'sub_category'}" class="sidebar-link"><i class="mdi mdi-subway"></i><span class="hide-menu"> اقسام الاخبار
                                            </span></router-link>
                                    </li>
                                    <li class="sidebar-item">
                                        <router-link :to="{name:'post'}" class="sidebar-link"><i class="mdi mdi-library"></i><span class="hide-menu"> الاخبار
                                            </span></router-link>
                                    </li>





                        @endif
                        @if(auth()->user()->is_organization())
                        <li class="sidebar-item">
                            <router-link :to="{name:'sub_category'}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> اقسام الاخبار
                                </span></router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name:'news'}" class="sidebar-link"><i class="mdi mdi-layers"></i><span class="hide-menu"> الاخبار </span></router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{ name: 'article',params: { id: {{Auth::user()->organization->id}} }}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> المقالات
                                </span></router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name:'jobs'}" class="sidebar-link"><i class="mdi mdi-layers"></i><span class="hide-menu"> الوظائف </span></router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link :to="{name:'application'}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> طلبات التوظيف
                                </span></router-link>
                        </li>
                        @endif
                    @if(auth()->user()->is_admin())


                            <li class="sidebar-item">
                                <router-link :to="{name:'jobs'}" class="sidebar-link"><i class="mdi mdi-layers"></i><span class="hide-menu"> الوظائف </span></router-link>
                            </li>

                            <li class="sidebar-item">
                                <router-link :to="{name:'application'}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> طلبات التوظيف
                                        </span></router-link>
                            </li>




                        @endif
                    </ul>



                </nav>


                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <!-- End Bottom points-->
        </aside>
        @yield('content')

    </div>


    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->



    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!-- End Bottom points-->




    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('js/app.js')}}"></script>

    <script src="{{AdminAssets()}}/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{AdminAssets()}}/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{AdminAssets()}}/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="{{AdminAssets()}}/dist/js/app.min.js"></script>
    <script src="{{AdminAssets()}}/dist/js/app.init.js"></script>
    <script src="{{AdminAssets()}}/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{AdminAssets()}}/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{AdminAssets()}}/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="{{AdminAssets()}}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{AdminAssets()}}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{AdminAssets()}}/dist/js/custom.min.js"></script>
    <script src="{{AdminAssets()}}/extra-libs/jquery-datatables-editable/jquery.dataTables.js"></script>
    <script src="{{AdminAssets()}}/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{AdminAssets()}}/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="{{AdminAssets()}}/extra-libs/jquery-datatables-editable/jquery.dataTables.js"></script>
    <script src="{{AdminAssets()}}/libs/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{AdminAssets()}}/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="{{AdminAssets()}}/extra-libs/tiny-editable/mindmup-editabletable.js"></script>
    <script src="{{AdminAssets()}}/extra-libs/tiny-editable/numeric-input-example.js"></script>
    <script src="{{AdminAssets()}}/libs/quill/dist/quill.min.js"></script>
    <!-- Initialize Quill editor -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
<script>
    $(document).ready( function () {
        $('#zero_config').DataTable();
    } );
</script>
</body>

</html>
