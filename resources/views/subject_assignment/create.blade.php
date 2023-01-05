@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Subject Assignment</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route("subject_assignment.store") }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id">
                                        @foreach ($subjects as $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Choose a subject</label>
                                    @error('subject_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('grade_id') is-invalid @enderror" name="grade_id">
                                        @foreach ($grades as $v)
                                            <option value="{{$v->id}}">{{$v->name}} - {{$v->academic_year->yearOne}}</option> 
                                        @endforeach
                                    </select>
                                    <label for="">Choose a grade</label>
                                    @error('grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label for="">Choose teacher</label>
                                    <select class="form-control @error('teachers') is-invalid @enderror" name="teachers[]" multiple>
                                        @foreach ($teachers as $v)
                                            <option value="{{$v->id}}"> {{$v->name}} </option> 
                                        @endforeach
                                    </select>

                                    @error('teachers')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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