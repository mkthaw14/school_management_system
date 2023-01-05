@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Teacher</h3></div>
                <div class="card-body">
                    <form method="POST" action="/teacher/{{$teacher->id}}" enctype="multipart/form-data">
                        @method("put")
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                      <button class="nav-link active" id="nav-old-tab" data-bs-toggle="tab" data-bs-target="#nav-old" type="button" role="tab" aria-controls="nav-old" aria-selected="true">Old</button>
                                      <button class="nav-link" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new" type="button" role="tab" aria-controls="nav-new" aria-selected="false">New</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-old" role="tabpanel" aria-labelledby="nav-old-tab" tabindex="0">
                                        <label for="profile" class="form-label">Profile</label>
                                        <div class="mb-3">
                                            <img src="{{$teacher->profile}}" alt="" width="100px" height="100px" >
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab" tabindex="0">
                                        <div class="mb-3">
                                            <label for="profile" class="form-label">Profile</label>
                                            <input type="file"  name="profile" class="form-control @error('profile') is-invalid @enderror" id="profile" placeholder="Image">
                                            @error('profile')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputYearTwo" type="text" name="name" value="{{ $teacher->name}}">
                                    <label for="inputYearTwo">Name</label>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('email') is-invalid @enderror" id="inputYearTwo" type="email" name="email" value="{{ $teacher->email}}">
                                    <label for="inputYearTwo">Email</label>
                                    @error('email')
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

                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label for="">Choose grade</label>
                                    <select class="form-control @error('grades') is-invalid @enderror" name="grades[]" multiple>
                                        @foreach ($grades as $v)
                                            <option value="{{$v->id}}" @foreach ($teacher->grades as $g) @if ($v->id == $g->id){{"selected"}}@endif @endforeach > {{$v->name}} - {{$v->academic_year->yearOne}} </option> 
                                        @endforeach
                                    </select>

                                    @error('grades')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('phone') is-invalid @enderror" id="inputYearTwo" type="text" name="phone" value="{{ $teacher->phone}}">
                                    <label for="inputYearTwo">Phone</label>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating">
                                    <input class="form-control @error('date_of_birth') is-invalid @enderror" id="inputYearTwo" type="date" name="date_of_birth" value="{{ $teacher->date_of_birth}}">
                                    <label for="inputYearTwo">Date of Birth</label>
                                    @error('date_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('education') is-invalid @enderror" id="inputYearTwo" type="text" name="education" value="{{ $teacher->education}}">
                                    <label for="inputYearTwo">Education</label>
                                    @error('education')
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