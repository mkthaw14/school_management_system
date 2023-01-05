@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Timetable</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route("timetable.store") }}">
                        @csrf
                        <div class="row mb-3">

                            
                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('') is-invalid @enderror" name="" id="grade">
                                        <option selected>Choose...</option>
                                        @foreach ($grades as $v)
                                            <option value="{{$v->id}}"> {{$v->name}} - {{$v->academic_year->yearOne}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Grade</label>
                                    @error('')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" disabled id="teacher">
                                        <option selected>Choose...</option>
  
                                    </select>
                                    <label for="">Teacher</label>
                                    @error('teacher_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" disabled id="subject">
                                        <option selected>Choose...</option>
   
                                    </select>
                                    <label for="">Subject</label>
                                    @error('subject_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('section_id') is-invalid @enderror" name="section_id" disabled id="section">
                                        <option selected>Choose...</option>
  
                                    </select>
                                    <label for="">Section</label>
                                    @error('section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('day_id') is-invalid @enderror" name="day_id">
                                        <option selected>Choose...</option>
                                        @foreach ($days as $v)
                                            <option value="{{$v->id}}"> {{$v->name}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Day</label>
                                    @error('day_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('time_id') is-invalid @enderror" name="time_id">
                                        <option selected>Choose...</option>
                                        @foreach ($times as $v)
                                            <option value="{{$v->id}}"> {{$v->period}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Time</label>
                                    @error('time_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 mb-0">
                            <div class="d-grid"> <button class="btn btn-primary">Save</button> </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_content')
    <script>
        $(document).ready(function() {
            //alert("hello");
            $("#grade").on("change", function() {
                //alert("yes");
                //alert($(this).val());
                let id = $(this).val();
                //alert(id);
                $.get("{{route('getteacherandsection')}}", {grade_id:id},function(res) {
                    console.log(res);
                    if(res.teachers.length > 0)
                    {
                        let teacher_opts = '<option selected>Choose...</option>';
                        res.teachers.forEach(function(el, index) {
                            //alert("yee : " + index);
                            teacher_opts += `<option value='${el.id}'>${el.name}</option>`;
                        });

                        $("#teacher").html(teacher_opts);
                        $("#teacher").prop("disabled", false);
                    }

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

            $("#teacher").on("change", function() {
                //alert("hello");
                let id = $(this).val();
                if(id == 'Choose...')
                    return;

                //alert("t : " + id);
                $.get("{{route('getsubject')}}", {teacher_id:id}, function(res) {
                    console.log(res);
                    if(res.subjects.length > 0)
                    {
                        let subject_opts = '<option selected>Choose...</option>';
                        res.subjects.forEach(function(el, index) {
                            //alert("yee : " + index);
                            subject_opts += `<option value='${el.id}'>${el.name}</option>`;
                        });

                        $("#subject").html(subject_opts);
                        $("#subject").prop("disabled", false);
                    }
                });
                
            });
        });
    </script>
@endsection