@extends('admin.layout.master')
@section('title')
    create
@endsection


@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">User Create</h5>
                <small class="text-muted float-end"><a href="{{ route('user.index') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back user List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Select Role Name</label>

                        <div class="mb-3">
                            <select class="form-select @error('role_id')
                                is-invalid
                            @enderror" aria-label="Default select example" name="role_id">
                                <option selected disabled>Open this select menu</option>

                                @foreach ($role_data as $value)
                                    <option value="{{ $value->id }}">{{ $value->role_name }}</option>
                                @endforeach


                              </select>

                              @error('role_id')

                              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>

                              @enderror


                        </div>

                        <label class="form-label" for="basic-default-fullname">User Name</label>
                        <input type="text" class="form-control @error('user_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter User Name" name="user_name">

                        @error('user_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">User Email</label>
                        <input type="email" class="form-control @error('user_email')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter User Email" name="user_email">

                        @error('user_email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">Password</label>
                        <input type="password" class="form-control @error('user_password')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter User Password" name="user_password">

                        @error('user_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>



    </div>
</div>

@endsection
