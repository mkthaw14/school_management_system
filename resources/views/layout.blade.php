<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Dagon Academy</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('/template/css/styles.css')}}" rel="stylesheet" />
        <link href="{{ asset('/template/css/mystyles.css')}}" rel="stylesheet" />
    

        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark my-nav-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">Dagon Academy</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto  me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             Logout</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">School</div>
                            <a class="nav-link " href="{{ route("academic_year.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Academic Year
                            </a>


                            <a class="nav-link " href="{{ route("grade.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Grade
                            </a>

                            <a class="nav-link " href="{{ route("section.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Section
                            </a>

                            <a class="nav-link " href="{{ route("teacher.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                                Teacher
                            </a>

                            <a class="nav-link " href="{{ route("student.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                                Student
                            </a>

                            <a class="nav-link " href="{{ route("subject.index")}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Subject
                            </a>


                            <div class="sb-sidenav-menu-heading">Timetable</div>
                            
                            <a class="nav-link" href="{{route('time.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Time
                            </a>
                            <a class="nav-link" href="{{route('day.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Day
                            </a>
                            <a class="nav-link" href="{{route('timetable.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Timetable
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('main-content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Dagon Academy 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src=" {{ asset("/template/js/scripts.js") }} "></script>

        @yield('script_content')

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src=" {{ asset("/template/js/datatables-simple-demo.js") }} ">
            $('#datatablesSimple').DataTable({
              "searching": true
            });
        </script>
        <script>
            $(document).ready(function() {
                let paginationLinks = $(".my-pagination-links nav div").get();
                if(paginationLinks.length > 0)
                {
                    //console.log(paginationLinks);
                    paginationLinks[3].remove();
                    //$(".my-pagination-links nav").addClass("");
                }

                //console.log(paginationLinks[3].remove());
            }); 
        </script>
        <script>
            $(document).ready(function() {
                console.log(window.location.href);
                const current_url = window.location.href;
                let a_tags = $(".list-view a");

                for(let i = 0; i < a_tags.length; i++)
                {
                    console.log(a_tags[i]);
                    let href = $(a_tags[i]).prop("href");
                    let paramIndex = current_url.indexOf("?");
                    let url = current_url;

                    if(paramIndex != -1)
                        url = current_url.substring(0, paramIndex);

                    console.log("Index : " + current_url.indexOf("?"));
                    if(href == url)
                    {
                        console.log("yes");
                        $(a_tags[i]).addClass("active");
                        $(a_tags[i]).css("border-bottom", "solid 3px rgb(11, 92, 42)");
                    }
                }
            });
        </script>
    </body>
</html>
