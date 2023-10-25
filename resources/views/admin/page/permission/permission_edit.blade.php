@extends('admin.layout.master')
@section('title')
    permission edit
@endsection


@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Permission Edit</h5>
                <small class="text-muted float-end"><a href="{{ route('permission.index') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Permission List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.update',$permission_name->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Select Module Name</label>

                        <div class="mb-3">
                            <select class="form-select @error('module_id')
                                is-invalid
                            @enderror" aria-label="Default select example" name="module_id">
                                <option selected disabled>Open this select menu</option>

                                @foreach ($module_data as $value)

                                        <option value="{{ $value->id }}" @if ($permission_name->module_id == $value->id)
                                            selected
                                        @endif>{{ $value->module_name }}</option>


                                @endforeach


                              </select>

                              @error('module_id')

                              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>

                              @enderror


                        </div>

                        <label class="form-label" for="basic-default-fullname">Permission Name</label>
                        <input type="text" class="form-control @error('permission_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Permission Name" name="permission_name" value="{{ $permission_name->permission_name }}">

                        @error('permission_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>



    </div>
</div>

@endsection
