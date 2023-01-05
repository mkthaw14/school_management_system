@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <h1 class="mt-4">Subject Assignment</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Tables</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <svg class="svg-inline--fa fa-table me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
            DataTable Example
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns"><div class="dataTable-top"><div class="dataTable-dropdown"><label><select class="dataTable-selector"><option value="5">5</option><option value="10" selected="">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select> entries per page</label></div><div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div></div><div class="dataTable-container"><table id="datatablesSimple" class="dataTable-table">
                <thead>
                    <tr>
                        <th data-sortable="" style="width: 19.5722%;">
                            <a href="#" class="dataTable-sorter">#</a>
                        </th>
                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Subject</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Grade</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Teachers</a>
                        </th>

                        <th data-sortable="" style="width: 28.984%;">
                            <a href="#" class="dataTable-sorter">Actions</a>
                        </th>

                    </tr>
                </thead>
                                    
                <tbody>
                    @foreach ($subjects as $k => $v)
                        <tr>
                            <td>{{ ++$k}}</td>
                            <td>{{$v->name}}</td>
                            <td>
                                @foreach ($v->subject_assignments as $s)
                                    {{$s->getGradeName($s->grade_id)}} <br>
                                @endforeach

                            </td>
                            <td>
                                @foreach ($v->subject_assignments as $s)
                                    {{$s->getTeacherName($s->teacher_id)}} <br>
                                @endforeach

                            </td>
                            <td class="d-flex">
                                <a href="/subject_assignment/{{$v->id}}/edit" class="btn btn-success">Edit</a>
    
                                <form action="/subject_assignment/{{$v->id}}" method="POST" class="mx-3">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger">Delete</button>
                                </form> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div><div class="dataTable-bottom"><div class="dataTable-info">Showing 1 to 10 of 57 entries</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"><li class="active"><a href="#" data-page="1">1</a></li><li class=""><a href="#" data-page="2">2</a></li><li class=""><a href="#" data-page="3">3</a></li><li class=""><a href="#" data-page="4">4</a></li><li class=""><a href="#" data-page="5">5</a></li><li class=""><a href="#" data-page="6">6</a></li><li class="pager"><a href="#" data-page="2">›</a></li></ul></nav></div></div>
        </div>
    </div>
</div>
@endsection
