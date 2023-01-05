@extends("layout")
@section("main-content")
<div class="container-fluid px-4">

    <div class="card mb-4">
        <div class="card-header">
            <div class="py-3 d-flex justify-content-between">
                <h3>Deleted Timetable List</h3>

                <a href="{{route('timetable.create')}}" class="btn btn-success">Create New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="pt-3 dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <div class="d-flex justify-content-between" >
                            <ul class="nav list-view">
                                <li class="nav-item">
                                  <a class="nav-link px-0 me-3 active" aria-current="page" href="{{route("timetable.index")}}">
                                    <i class="fa-solid fa-table fa-lg"></i>
                                </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link px-0 me-3" href="/timetable/list">
                                        <i class="fa-solid fa-table-list fa-lg"></i>
                                  </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link px-0 me-3" href="/timetable/deleted">
                                    <i class="fa-solid fa-trash-can-arrow-up fa-lg"></i>
                                </a>
                                </li>
                              </ul>
                        </div>
                    </div>
                    <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
                </div>
                    <div class="dataTable-container"><table id="datatablesSimple" class="dataTable-table">
                <thead>
                    <tr>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">#</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Day</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Time</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Teacher</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Section</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Subject</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Actions</a>
                        </th>
                    </tr>
                </thead>
                                    
                <tbody>
                    @foreach ($timetables as $k => $v)
                        <tr>
                            <td> {{++$k}}</td>
                            <td>{{$v->getDay($v->day_id)->name}}</td>
                            <td>{{$v->getTime($v->time_id)->period}}</td>
                            <td>{{$v->getTeacher($v->teacher_id)->name}}</td>
                            <td>{{$v->getSection($v->section_id)->name}}</td>
                            <td>{{$v->getSubject($v->subject_id)->name}}</td>
                            <td class="d-flex">

                                <form action="/timetable/{{ $v->id }}/restore" method="POST" class="mx-2">
                                    @method("put")
                                    @csrf

                                    <button class="btn btn-success">Restore</button>
                                </form>                                    
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
            <div class="my-pagination-links">
                {{$timetables->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
