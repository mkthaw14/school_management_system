@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Grade</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route("grade.store") }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3 ">
                                    <select class="form-control @error('academic_year_id') is-invalid @enderror" name="academic_year_id">
                                        @foreach ($academic_years as $v)
                                            <option value="{{$v->id}}"> {{$v->yearOne}} - {{$v->yearTwo}} </option> 
                                        @endforeach
                                    </select>
                                    <label for="">Choose an academic year</label>
                                    @error('academic_year_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputYearTwo" type="text" name="name">

                                    <label for="inputYearTwo">Grade Name</label>
                                    @error('name')
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