@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div>
        @if ($academic_year && $academic_year->yearOne != date("Y"))
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Warning, the latest academic year in database is {{$academic_year->yearOne}}-{{$academic_year->yearTwo}}.</h4>
                <p>Please insert an academic year for this year.</p>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Academic Year</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    @if ($academic_year)
                    <h4>{{$academic_year->yearOne}}-{{$academic_year->yearTwo}}</h4>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Teachers</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h4>{{count($teachers)}}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Students</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h4>{{count($students)}}</h4>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Subjects</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h4>{{count($subjects)}}</h4>
                </div>
            </div>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-header">
            <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->

        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">

                    </div>
                    <div class="dataTable-search">

                    </div>
                </div>
                <div class="dataTable-container">
                    <table id="datatablesSimple" class="dataTable-table">
                <thead>
                    <tr>
                        <th data-sortable="" rowspan="2" class="align-middle">
                            <a href="#" class="dataTable-sorter text-center" >#</a>
                        </th>
                        <th data-sortable="" rowspan="2" class="align-middle" >
                            <a href="#" class="dataTable-sorter text-center" >Grade</a>
                        </th>
                        <th data-sortable="" colspan="2" class="align-middle">
                            <a href="#" class="dataTable-sorter text-center">Students</a>
                        </th>
                        <th data-sortable="" rowspan="2"  class="align-middle">
                            <a href="#" class="dataTable-sorter text-center">Teachers</a>
                        </th>
                    </tr>
                    <tr>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter text-center">Male</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter text-center">Female</a>
                        </th>
                    </tr>


                </thead>
                                    
                <tbody>
                    @foreach ($grades as $k => $g)
                        <tr>
                            <td>{{++$k}}</td>
                            <td>{{$g->name}}</td>
                            <td>{{count($g->getStudentsByGender('male'))}}</td>
                            <td>{{count($g->getStudentsByGender('female'))}}</td>
                            <td>{{count($g->teachers)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
            <div class="my-pagination-links">
                @if ($grades)
                {{$grades->links()}}
                @endif

            </div>
        
        </div>
        </div>
    </div>
</div>
@endsection

@section('script_content')
<script src="{{ asset("/template/assets/demo/Chart.min.js")}}" crossorigin="anonymous"></script>
<script src=" {{ asset("/template/assets/demo/chart-area-demo.js") }} "></script>
<script src=" {{ asset("/template/assets/demo/chart-bar-demo.js") }} "></script>   
@endsection