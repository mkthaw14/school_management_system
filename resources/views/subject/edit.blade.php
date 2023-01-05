@extends("layout")
@section("main-content")
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Subject</h3></div>
                <div class="card-body">
                    <form method="POST" action="/subject/{{$subject->id}}">
                        @csrf
                        @method("put")
                        <div class="row mb-3">

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputYearTwo" type="text" name="name" value="{{$subject->name}}">
                                    <label for="inputYearTwo">Name</label>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3 ">
                                    <label for="">Choose teacher</label>
                                    <select class="form-control @error('teachers') is-invalid @enderror" name="teachers[]" multiple>
                                        @foreach ($teachers as $v)
                                            <option value="{{$v->id}}" @foreach ($subject->teachers as $t) @if($v->id == $t->id) {{"selected"}} @endif @endforeach > {{$v->name}} </option> 
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