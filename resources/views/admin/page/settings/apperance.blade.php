@extends('admin.layout.master')
@section('title') apperance @endsection

@push('admin_style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@endpush

@section('index')
<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Apperance Setting Create</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Dashboard</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.apperance.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">

                        <label class="form-label" for="site_bg_color">Site Background Color</label>
                        <input type="text" class="form-control @error('site_bg_color')
                            is-invalid

                        @enderror" id="site_bg_color" placeholder="Site Background Color" name="site_bg_color" value="{{ Setting('site_bg_color') }}" >

                        @error('site_bg_color')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label mt-3" for="basic-default-fullname">Site Logo</label>
                        <input type="file" class="dropify" data-height="200" name="logo_img" data-default-file="{{ asset('uploads/system_img') }}/{{ Setting('logo_img') }}" />

                    </div>

                    <div class="mb-3">

                        <label class="form-label mt-3" for="basic-default-fullname">Site Favicon (Size: 32x32)</label>
                        <input type="file" class="dropify" data-height="200" name="favicon" data-default-file="{{ asset('uploads/system_img') }}/{{ Setting('favicon') }}" />

                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>

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
