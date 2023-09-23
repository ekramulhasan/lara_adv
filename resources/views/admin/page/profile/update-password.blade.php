@extends('admin.layout.master')
@section('title')
    password update
@endsection

@push('admin_style')

@endpush

@section('index')
    <div class="row">

        <div class="col">

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Password Update</h5>
                    <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-primary"> <i
                                class='bx bx-left-arrow-alt'></i> Back Dashboard</a></small>
                </div>
                <div class="card-body">

                    <form action="{{ route('post.update.password') }}" method="POST">
                        @csrf

                        <div class="mb-3">

                            <label class="form-label" for="basic-default-fullname">Old Password</label>
                            <input type="password"
                                class="form-control @error('old_password')
                            is-invalid
                            @enderror"
                            id="basic-default-fullname" placeholder="Enter Old Password" name="old_password">

                            @error('old_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror


                        </div>


                        <div class="mb-3">

                            <label class="form-label" for="basic-default-fullname">New Password</label>
                            <input type="password"
                                class="form-control @error('new_password')
                            is-invalid
                            @enderror"
                            id="basic-default-fullname" placeholder="Enter New Password" name="new_password">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="basic-default-fullname">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('confirm_password')
                            is-invalid
                            @enderror"
                            id="basic-default-fullname" placeholder="Confirm Password" name="confirm_password">

                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror


                        </div>

                        <button type="submit" class="btn btn-primary ">Update</button>

                    </form>
                </div>
            </div>



        </div>
    </div>
@endsection


@push('admin_script')

@endpush
