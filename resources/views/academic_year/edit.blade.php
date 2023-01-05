@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Academic Year</h3></div>
                <div class="card-body">
                    <form method="POST" action="/academic_year/{{$academicYear->id}}">
                        @method("put")
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('yearOne') is-invalid @enderror" id="inputYearOne" type="text" name="yearOne" value="{{$academicYear->yearOne}}">
                                    <label for="inputYearOne">Year One</label>
                                    @error('yearOne')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control @error('yearTwo') is-invalid @enderror" id="inputYearTwo" type="text" name="yearTwo" value="{{$academicYear->yearTwo}}">
                                    <label for="inputYearTwo">Year Two</label>
                                    @error('yearTwo')
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