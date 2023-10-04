@extends('admin.layout.master')
@section('title') Socialite @endsection

@push('admin_style')

@endpush

@section('index')
<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Socialite Setting Create</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Dashboard</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.socialite.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">

                        <label class="form-label" for="github_client_id">Github Client Id</label>
                        <input type="text" class="form-control @error('github_client_id')
                            is-invalid

                        @enderror" id="github_client_id" placeholder="Github Client Id" name="github_client_id" value="{{ Setting('github_client_id') }}" >

                        @error('github_client_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="github_client_secret_id">Github Client Secret ID</label>
                        <input type="text" class="form-control @error('github_client_secret_id')
                            is-inhost
                        @enderror" id="github_client_secret_id" placeholder="Github Client Secret ID" name="github_client_secret_id" value="{{ Setting('github_client_secret_id') }}" >

                        @error('github_client_secret_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="github_redirect_url">Github Client Redirect URL</label>
                        <input type="text" class="form-control @error('github_redirect_url')
                            is-invalid

                        @enderror" id="github_redirect_url" placeholder="Github Client Redirect URL" name="github_redirect_url" value="{{ Setting('github_redirect_url') }}" >

                        @error('github_redirect_url')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>


                    {{-- gmail login --}}

                    <div class="mb-3">

                        <label class="form-label" for="google_client_id">google Client Id</label>
                        <input type="text" class="form-control @error('google_client_id')
                        is-invalid

                        @enderror" id="google_client_id" placeholder="Google Client Id" name="google_client_id" value="{{ Setting('google_client_id') }}" >

                        @error('google_client_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="google_client_secret_id">google Client Secret ID</label>
                        <input type="text" class="form-control @error('google_client_secret_id')
                            is-inhost
                        @enderror" id="google_client_secret_id" placeholder="Google Client Secret ID" name="google_client_secret_id" value="{{ Setting('google_client_secret_id') }}" >

                        @error('google_client_secret_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="google_redirect_url">google Client Redirect URL</label>
                        <input type="text" class="form-control @error('google_redirect_url')
                            is-invalid

                        @enderror" id="google_redirect_url" placeholder="Google Client Redirect URL" name="google_redirect_url" value="{{ Setting('google_redirect_url') }}" >

                        @error('google_redirect_url')
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
