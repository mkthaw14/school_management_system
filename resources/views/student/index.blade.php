@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="py-3 d-flex justify-content-between">
                <h3>Student List</h3>

                <a href="{{route('student.create')}}" class="btn btn-success">Create New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-3 dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top"><div class="dataTable-dropdown">
                    <div class="d-flex justify-content-between" >
                        <ul class="nav list-view">
                            <li class="nav-item">
                              <a class="nav-link px-0 me-3 active" aria-current="page" href="{{route("student.index")}}">
                                <i class="fa-solid fa-table fa-lg"></i>
                            </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link px-0 me-3" href="/student/deleted">
                                <i class="fa-solid fa-trash-can-arrow-up fa-lg"></i>
                            </a>
                            </li>

                          </ul>

                    </div>
                </div>
                <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div></div><div class="dataTable-container"><table id="datatablesSimple" class="dataTable-table">
                <thead>
                    <tr>
                        <th data-sortable="" style="width: 19.5722%;">
                            <a href="#" class="dataTable-sorter">#</a>
                        </th>
                        <th data-sortable="" >
                            <a href="#" class="dataTable-sorter">Profile</a>
                        </th>
                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Name</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">NRC</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Gender</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Date of Birth</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Age</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Section</a>
                        </th>
                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Grade</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Actions</a>
                        </th>

                    </tr>
                </thead>
                                    
                <tbody>
                    @foreach ($students as $k => $v)
                        <tr>
                            <td>{{ ++$k}}</td>
                            <td><img src="{{$v->profile}}" alt="{{$v->profile}}" width="100px" height="100px"></td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->nrc}}</td>
                            <td>{{$v->gender}}</td>
                            <td>{{$v->date_of_birth}}</td>
                            <td>{{$v->getAge()}}</td>
                            <td>{{$v->section->name}}</td>
                            <td>{{$v->section->grade->name}}</td>
                            <td class="d-flex">
                                <a href="/student/{{$v->id}}/edit" class="btn btn-success">Edit</a>
    
                                <form action="/student/{{$v->id}}" method="POST" class="mx-3">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger">Delete</button>
                                </form> 

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
            <div class="my-pagination-links">
                {{$students->links()}}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
