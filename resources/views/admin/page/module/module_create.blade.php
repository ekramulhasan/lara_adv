@extends('admin.layout.master')
@section('title')
    dashboard
@endsection


@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Module Create</h5>
                <small class="text-muted float-end"><a href="{{ route('module.index') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Module List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('module.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Module Name</label>
                        <input type="text" class="form-control @error('module_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Module Name" name="module_name">

                        @error('module_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>



    </div>
</div>

@endsection
