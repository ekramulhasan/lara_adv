@extends('admin.layout.master')
@section('title') mail @endsection

@push('admin_style')

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
                <form action="{{ route('settings.mail.update') }}" method="POST">
                    @csrf

                    <div class="mb-3">

                        <label class="form-label" for="mail_mailer">Mail Mailer</label>
                        <input type="text" class="form-control @error('mail_mailer')
                            is-invalid

                        @enderror" id="mail_mailer" placeholder="Mail Mailer" name="mail_mailer" value="{{ Setting('mail_mailer') }}" >

                        @error('mail_mailer')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_host">Mail Host</label>
                        <input type="text" class="form-control @error('mail_host')
                            is-inhost
                        @enderror" id="mail_host" placeholder="Mail Host" name="mail_host" value="{{ Setting('mail_host') }}" >

                        @error('mail_host')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_port">Mail Port</label>
                        <input type="text" class="form-control @error('mail_port')
                            is-invalid

                        @enderror" id="mail_port" placeholder="Mail Port" name="mail_port" value="{{ Setting('mail_port') }}" >

                        @error('mail_port')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_user">Mail User</label>
                        <input type="text" class="form-control @error('mail_user')
                            is-invalid

                        @enderror" id="mail_user" placeholder="Mail User" name="mail_user" value="{{ Setting('mail_user') }}" >

                        @error('mail_user')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_password">Mail Password</label>
                        <input type="text" class="form-control @error('mail_password')
                            is-invalid

                        @enderror" id="mail_password" placeholder="Mail Password" name="mail_password" value="{{ Setting('mail_password') }}" >

                        @error('mail_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_encryption">Mail Encryption</label>
                        <input type="text" class="form-control @error('mail_encryption')
                            is-invalid

                        @enderror" id="mail_encryption" placeholder="Mail Encryption" name="mail_encryption" value="{{ Setting('mail_encryption') }}" >

                        @error('mail_encryption')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="mail_from_address">Mail From Address</label>
                        <input type="email" class="form-control @error('mail_from_address')
                            is-invalid

                        @enderror" id="mail_from_address" placeholder="Mail From Address" name="mail_from_address" value="{{ Setting('mail_from_address') }}" >

                        @error('mail_from_address')
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
