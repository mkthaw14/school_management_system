@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Time</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route("time.store") }}">
                        @csrf
                        <div class="row mb-3">              
                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('period') is-invalid @enderror" id="inputYearTwo" type="text" name="period" value="{{ old("period")}}">
                                    <label for="inputYearTwo">Period</label>
                                    @error('period')
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