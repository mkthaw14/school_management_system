@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div>
        @if ($academic_year && $academic_year->yearOne != date("Y"))
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Warning, you are viewing the timetable which is in {{$academic_year->yearOne}}-{{$academic_year->yearTwo}} academic year.</h4>
            <p>Please insert an academic year for this year.</p>
        </div>
        @endif
    </div>
    <!--Timetable-->
    <section>
        <div class="card mb-4">
            <div class="card-header">
                <div class="py-3 d-flex justify-content-between">
                    <h3>Timetable</h3>

                    <a href="{{route('timetable.create')}}" class="btn btn-success">Create New</a>
                </div>
            </div>
            <div class="card-body">
                <div class="pt-3 dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                    <div class="dataTable-top ">
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

                        <div class="dataTable-search">
                            <div >
                                <form method="POST" class="d-flex justify-content-around row" id="table-search-form">
                                    @csrf

                                    <div class="mb-3" id="selection">
                                        <select class="form-select" name="table_type" id="table-search">
                                            <option value="1">Overall table</option>
                                            <option value="2">Teacher Table</option>
                                            <option value="3">Section Table</option>
                                    
                                        </select>
                                    </div>

                                    <div class="mb-3" id="table-selection"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dataTable-container" id="table-container">
                        <table id="datatablesSimple" class="dataTable-table" >
                            <thead >
                                <tr>
                                    <th data-sortable="" rowspan="2" class="align-middle">
                                        <a href="#" class="dataTable-sorter text-center" style="width: 1px;">#</a>
                                    </th>
                                    <th data-sortable="" rowspan="2" class="align-middle" style="width: 10%; ">
                                        <a href="#" class="dataTable-sorter text-center ">Teacher Name</a>
                                    </th>

                                    
                                    @foreach ($days as $d)
                                        <th data-sortable="" colspan="{{count($times)}}" >
                                            <a href="#" class="dataTable-sorter text-center">{{$d->name}}</a>
                                        </th>
                                    @endforeach
                                </tr>

                                <tr>
                                    @foreach ($days as $d)
                                        @foreach ($times as $key => $time)
                                            <th data-sortable="" >
                                                <a href="#" class="dataTable-sorter" style="width: 80px; ">{{++$key}}</a>
                                            </th>   
                                        @endforeach   
                                    @endforeach
                                
                                </tr>
                            </thead>                                           
                            <tbody>
                                <tr>
                                    @foreach ($teachers as $t_key => $teacher)
                                        <tr>
                                            <td data-sortable="">{{++$t_key}}</td>
                                            <td data-sortable="">{{$teacher->name}}</td>
                                            @foreach ($days as $d)
                                                @foreach ($times as $key => $time)
                                                    @php
                                                        $teacher_timetable = $timetable->getByTeacherIDAndDayIDAndTimeID($teacher->id, $d->id, $time->id);   
                                                    @endphp
                                                    <td data-sortable="" id="table-id-{{$key}}" style="cursor: pointer" class="table-td" data-timetable="@if($teacher_timetable){{$teacher_timetable->id}}@else{{0}}@endif" data-teachername="{{$teacher->name}}" data-dayname="{{$d->name}}" data-timename="{{$time->period}}" data-teacherid="{{$teacher->id}}" data-dayid="{{$d->id}}" data-timeid="{{$time->id}}">
                                                        @php
                                                            if($teacher_timetable)
                                                            {
                                                                $section = $timetable->getSection($teacher_timetable->section_id);
                                                                if($section)
                                                                {
                                                                    $subject = $timetable->getSubject($teacher_timetable->subject_id);
                                                                    echo $section->grade->name."-".$section->name."<br>";
                                                                    echo $subject->name;

                                                        @endphp
                                                                    <input type="hidden" value="{{$section->grade->id}}" name="g-name">
                                                                    <input type="hidden" value="{{$section->id}}" name="sec-name">
                                                                    <input type="hidden" value="{{$subject->id}}" name="sub-name">
                                                        @php
                                                                }          


                                                            }
                                                        @endphp
                                                    </td>   
                                                @endforeach   
                                            @endforeach
                                        </tr>
                                    @endforeach                           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-bottom">
                            <nav class="dataTable-pagination">

                            </nav>
                    </div>
                </div>
            </div>
        </div>
        
          <!-- Modal -->
          <div class="modal fade" id="timetableModal" tabindex="-1" aria-labelledby="timetableModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="timetableModalLabel"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="timetable-form" method="POST" action="">
                        @csrf
                        <div class="method-overide d-none">

                        </div>

                        <div class="col-md-12">
                            <div class="form-floating mb-3 ">
                                <select class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" disabled id="teacher" value="{{old("teacher_id")}}">
                                    <option selected>Choose...</option>
  
                                </select>
                                <label for="">Teacher</label>

                            </div>
                        </div>

                        <div class="row mb-3">          

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('day_id') is-invalid @enderror" name="day_id" id="day" disabled>
                                        <option value="" selected>Choose...</option>

                                    </select>
                                    <label for="">Day</label>
 
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('time_id') is-invalid @enderror" name="time_id" id="time" disabled>
                                        <option selected>Choose...</option>

                                    </select>
                                    <label for="">Time</label>
  
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('') is-invalid @enderror" name="" id="grade" required>
                                        <option selected>Choose...</option>
                                        @foreach ($grades as $v)
                                            <option value="{{$v->id}}"> {{$v->name}} - {{$v->academic_year->yearOne}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Grade</label>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('section_id') is-invalid @enderror" name="section_id" disabled id="section" required>
                                        <option value="" selected>Choose...</option>
  
                                    </select>
                                    <label for="">Section</label>
   
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" disabled id="subject" required>
                                        <option value="" selected>Choose...</option>
   
                                    </select>
                                    <label for="">Subject</label>

                                </div>
                            </div>
                        </div>


                        <div class="mt-4 mb-0">
                            <div class="d-flex justify-content-between" id="modal-btns"> 

                             </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">


                </div>
              </div>
            </div>
          </div>


          <!--Delete form-->
          <form action="" id="delete-form" method="POST" class="d-none">
                @csrf
                @method('delete')
                <button type="submit">Submit</button>
          </form>
    </section>
    <!--End Overall Timetable-->

@endsection

@section('script_content')
    <script>
        $(document).ready(function() {
            //alert("hello");

            $(document).on("click", "#timetableModal #delete-btn" , function(e) {
                e.preventDefault();
                let timetableId = $(this).data("id");
                if(confirm("Are you sure?"))
                {
                    console.log("Yes");
                    let route = `{{route("timetable.update", ':timetable')}}`;
                    route = route.replace(":timetable", timetableId);
                    $("#delete-form").prop("action", route);
                    $("#delete-form").submit();
                }
            });
            
            $(document).on("click", ".card tbody .table-td" ,function() {
                let timetableId = $(this).data("timetable");
                let teacherId = $(this).data("teacherid");
                let dayId = $(this).data("dayid");
                let timeId = $(this).data("timeid");
                let teacherName = $(this).data("teachername");
                let dayName = $(this).data("dayname");
                let timeName = $(this).data("timename");

                let gradeId = "Choose...";
                let sectionId = "Choose...";
                let subjectId = 0;
                
                //alert(timetableId);
                if(timetableId == 0)
                {
                    $("#timetable-form").prop("action", "{{route("timetable.store")}}");
                    $(".method-overide").html('');
                    $("#section").html("<option selected>Choose...</option>");
                    $("#timetableModalLabel").text("Create Timetable");


                    let btns = `
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary ">Save</button>
                    `;
                    $("#modal-btns").html(btns);
                }
                else
                {
                    $("#timetableModalLabel").text("Edit Timetable");
                    let route = `{{route("timetable.update", ':timetable')}}`;
                    route = route.replace(":timetable", timetableId);
                    $("#timetable-form").prop("action", route);
                    $(".method-overide").html(`@method('put')`);

                    let btns = `

                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary ">Save</button>
                                    <button class="btn btn-danger" id="delete-btn" data-id=${timetableId}>Delete</button>

                    `;

                    $("#modal-btns").html(btns);
            
                    let grade_id = $(this).data("grade");
                    //let subject_id = $(this).prop("id");
                    //alert(subject_id);

                    let inputs = $(this).children("input");
                    console.log(inputs);
                    for(let i = 0; i < inputs.length; i++)
                    {
                        console.log($(inputs[i]).val());
                    }

                    gradeId = $(inputs[0]).val();
                    sectionId = $(inputs[1]).val();
                    subjectId = $(inputs[2]).val();

                    $.get("{{route('getsection')}}", {grade_id:gradeId},function(res) {
                        console.log(res);


                        if(res.sections.length > 0)
                        {
                            let section_opts = '<option selected>Choose...</option>';
                            res.sections.forEach(function(el, index) {
                                //alert("yee : " + index);
                                let selected = "";
                                if(el.id == sectionId)
                                    selected = "selected";

                                section_opts += `<option value='${el.id}' ${selected}>${el.name}</option>`;
                            });

                            $("#section").html(section_opts);
                            $("#section").prop("disabled", false);
                            //$("#subject").prop("disabled", false);
                        }


                    });
                }

                console.log("grade_id" + gradeId +  " subject_id " + subjectId + " section_id " + sectionId);
                //let form = $("#timetable-form").prop("action", "{{route("timetable.save")}}");

                //alert(teacherId + ", d" + dayId + ", t" + timeId);
                
                createModal(teacherId, teacherName, dayId, dayName, timeId, timeName, gradeId, sectionId, subjectId);
                //$("#timetable-modal").click();
            });


            $("#table-search").on("change", function() {
                let id = $(this).val();

                if(id == 1)
                {
                    //$("#selection").removeClass("col-6");
                    let htm = `

                    `;

                    $.get("{{route('getoveralltimetable')}}", {},function(res) {
                        console.log(res);
                        $("#table-container").html(res);
                    });


                    $("#table-selection").html('');
                }
                else if(id == 2)
                {
                    let htm = `
                    <select class="form-select @error('teacher_id') is-invalid @enderror" name="teacher_id" id="teacher-search">
                        <option selected>Select Teacher</option>
                        @foreach ($teachers as $t)
                            <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                    </select>
                    `;

                    $("#table-selection").html(htm);
                    //$("#table-selection").addClass("col-6");
                    //$("#selection").addClass("col-6");
                    
                }
                else if(id == 3)
                {
                    let htm = `
                    <select class="form-control @error('section_id') is-invalid @enderror" name="section_id" id="section-search">
                        <option selected>Select Section</option>
                        @foreach ($sections as $s)
                            <option value="{{$s->id}}">{{$s->name}}-{{$s->grade->name}}-{{$s->grade->academic_year->yearOne}} </option>
                        @endforeach
                    </select>
                    `;

                    $("#table-selection").html(htm);
                    //$("#table-selection").addClass("col-6");
                    //$("#selection").addClass("col-6");
                }
                
            });

            $("#grade").on("change", function() {
                //alert("yes");
                //alert($(this).val());
                let id = $(this).val();
                //alert(id);
                $.get("{{route('getsection')}}", {grade_id:id},function(res) {
                    console.log(res);


                    if(res.sections.length > 0)
                    {
                        let section_opts = '<option selected>Choose...</option>';
                        res.sections.forEach(function(el, index) {
                            //alert("yee : " + index);
                            section_opts += `<option value='${el.id}'>${el.name}</option>`;
                        });

                        $("#section").html(section_opts);
                        $("#section").prop("disabled", false);
                    }
                });
            });

            $(document).on("change", "#teacher-search", function() {
                console.log($(this).val());

                let id = $(this).val();
                if(id != "Select Teacher")
                {
                    $.get("{{route('searchteacher')}}", {teacher_id:id}, function(res) {
                        //console.log(res);
                        $("#table-container").html(res);
                    }).fail(function(err) {
                        console.log(err);
                    });
                }
                else
                {
                    //$("#table-container").html('');
                }
       
            });

            $(document).on("change", "#section-search", function() {
                console.log($(this).val());

                let id = $(this).val();
                if(id != "Select Section")
                {
                    $.get("{{route('searchsection')}}", {section_id:id}, function(res) {
                        //console.log(res);
                        $("#table-container").html(res);
                    }).fail(function(err) {
                        console.log(err);
                    });
                }
                else
                {
                    //$("#table-container").html('');
                }

            });
        });

        function createModal(teacherId, teacherName, dayId, dayName, timeId, timeName, gradeId, sectionId, subjectId)
        {
            if(teacherName == undefined)
            {
                console.log("undef")
            }
            $("#teacher").prop("disabled", false);
            $("#day").prop("disabled", false);
            $("#time").prop("disabled", false);

            $("#timetableModal").modal("toggle");
            $("#teacher").html(`<option value='${teacherId}'>${teacherName}</option>`);
            $("#day").html(`<option value='${dayId}'>${dayName}</option>`);
            $("#time").html(`<option value='${timeId}'>${timeName}</option>`);

            $("#grade").val(gradeId);
            $("#section").val(sectionId);
                

            $.get("{{route('getsubject')}}", {teacher_id:teacherId},function(res) {
                console.log(res);
                if(res.subjects.length > 0)
                {
                    let subject_opts = '<option selected>Choose...</option>';
                    res.subjects.forEach(function(el, index) {
                        //alert("yee : " + index);
                        let selected = "";
                        if(el.id == subjectId)
                            selected = "selected";

                        subject_opts += `<option value='${el.id}' ${selected}>${el.name}</option>`;
                    });

                    $("#subject").html(subject_opts);
                    $("#subject").prop("disabled", false);
                }
            });
        }
    </script>
@endsection