@extends('admin.layout.master')
@section('title') profile update @endsection

@push('admin_style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Profile Update</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Dashboard</a></small>
            </div>
            <div class="card-body">

                <form action="{{ route('post.update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">

                        <label class="form-label" for="basic-default-fullname">User Name</label>
                        <input type="text" class="form-control @error('user_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter User Name" name="user_name" value="{{ $user->name }}">

                        @error('user_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">User Email</label>
                        <input type="email" class="form-control mb-3 @error('user_email')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter User Email" name="user_email" value="{{ $user->email }}">

                        @error('user_email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <label class="form-label mt-3" for="basic-default-fullname">User Image</label>
                        <input type="file" class="dropify" data-height="200" name="user_img" data-default-file="{{ asset('uploads/profile_img')}}/{{ $user->user_img }}" />

                    </div>

                    <button type="submit" class="btn btn-primary ">Update</button>

                </form>
            </div>
        </div>



    </div>
</div>




@endsection


@push('admin_script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    $(document).ready(function() {

        $('.dropify').dropify();

    })
</script>

@endpush
