@extends('admin.layout.master')
@section('title') setting @endsection

@push('admin_style')

@endpush

@section('index')
<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">General Setting Create</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Dashboard</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.general.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">

                        <label class="form-label" for="site_title">Site Title</label>
                        <input type="text" class="form-control @error('site_title')
                            is-invalid

                        @enderror" id="site_title" placeholder="Site Title" name="site_title" value="{{ Setting('site_title') }}" >

                        @error('site_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_address">Site Address</label>
                        <input type="text" class="form-control @error('site_address')
                            is-invalid

                        @enderror" id="site_address" placeholder="Site Address" name="site_address" value="{{ Setting('site_address') }}">

                        @error('site_address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_phone">Site Phone</label>
                        <input type="text" class="form-control @error('site_phone')
                            is-invalid

                        @enderror" id="site_phone" placeholder="Site Phone" name="site_phone" value="{{ Setting('site_phone') }}">

                        @error('site_phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_email">Site Email</label>
                        <input type="text" class="form-control @error('site_email')
                            is-invalid

                        @enderror" id="site_email" placeholder="Site Email" name="site_email" value="{{ Setting('site_email') }}">

                        @error('site_email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_facebook_link">Site Facebook Link (<i class='bx bxl-facebook-square'></i>)</label>
                        <input type="text" class="form-control @error('site_facebook_link')
                            is-invalid

                        @enderror" id="site_facebook_link" placeholder="Site Facebook Link" name="site_facebook_link" value="{{ Setting('site_facebook_link') }}">

                        @error('site_facebook_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_linkeding_link">Site Linkedin Link (<i class='bx bxl-linkedin-square' ></i>)</label>
                        <input type="text" class="form-control @error('site_linkeding_link')
                            is-invalid

                        @enderror" id="site_linkeding_link" placeholder="Site Linkedin Link" name="site_linkeding_link" value="{{ Setting('site_facebook_link') }}">

                        @error('site_linkeding_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="site_description">Site Description</label>
                        <textarea name="site_description" id="" cols="30" rows="10" class="form-control @error('site_description')
                        is-invalid

                    @enderror" id="site_description">{{ Setting('site_description') }}</textarea>


                        @error('site_description')
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


@push('admin_script')

@endpush
