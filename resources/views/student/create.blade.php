@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Student</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route("student.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('section_id') is-invalid @enderror" name="section_id">
                                        @foreach ($sections as $v)
                                            <option value="{{$v->id}}">{{$v->grade->name}} - {{$v->name }} </option> 
                                        @endforeach
                                    </select>
                                    <label for="">Choose a section</label>
                                    @error('section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputYearTwo" type="text" name="name" value="{{ old("name")}}">
                                    <label for="inputYearTwo">Name</label>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="">
                                    <input class="form-control @error('profile') is-invalid @enderror" id="inputYearTwo" type="file" name="profile" >

                                    @error('profile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('nrc') is-invalid @enderror" id="inputYearTwo" type="text" name="nrc" value="{{ old("nrc")}}">
                                    <label for="inputYearTwo">NRC</label>
                                    @error('nrc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender-male" value="male">
                                    <label class="form-check-label" for="gender-male">
                                      Male
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender-female" checked value="female">
                                    <label class="form-check-label" for="gender-female">
                                      Female
                                    </label>
                                  </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating">
                                    <input class="form-control @error('date_of_birth') is-invalid @enderror" id="inputYearTwo" type="date" name="date_of_birth" value="{{ old("date_of_birth")}}">
                                    <label for="inputYearTwo">Date of Birth</label>
                                    @error('date_of_birth')
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