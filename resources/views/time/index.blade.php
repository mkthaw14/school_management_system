@extends("layout")
@section("main-content")
<div class="container-fluid px-4">

    <div class="card mb-4">
        <div class="card-header">
            <div class="py-3 d-flex justify-content-between">
                <h3>Time List</h3>

                <a href="{{route('time.create')}}" class="btn btn-success">Create New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="pt-3 dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <div class="d-flex justify-content-between" >
                            <ul class="nav list-view">
                                <li class="nav-item">
                                  <a class="nav-link px-0 me-3 active" aria-current="page" href="{{route("time.index")}}">
                                    <i class="fa-solid fa-table fa-lg"></i>
                                </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link px-0 me-3" href="/time/deleted">
                                    <i class="fa-solid fa-trash-can-arrow-up fa-lg"></i>
                                </a>
                                </li>

                              </ul>

                        </div>
                    </div><div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div></div><div class="dataTable-container"><table id="datatablesSimple" class="dataTable-table">
                <thead>
                    <tr>
                        <th data-sortable="" style="width: 19.5722%;">
                            <a href="#" class="dataTable-sorter">#</a>
                        </th>
                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Name</a>
                        </th>
                        <th data-sortable="" style="width: 9.19786%;">
                            <a href="#" class="dataTable-sorter">Actions</a>
                        </th>
                    </tr>
                </thead>
                                    
                <tbody>
                    @foreach ($times as $k => $v)
                        <tr>
                            <td> {{++$k}}</td>
                            <td>{{$v->period}}</td>
                            <td class="d-flex">
                                <a href="/time/{{ $v->id }}/edit" class="btn btn-success">Edit</a>

                                <form action="/time/{{ $v->id }}" method="POST" class="mx-2">
                                    @method("delete")
                                    @csrf

                                    <button class="btn btn-danger">Delete</button>
                                </form>                                    
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
            <div class="my-pagination-links">
                {{$times->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
