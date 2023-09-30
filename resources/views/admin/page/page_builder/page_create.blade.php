@extends('admin.layout.master')
@section('title')
   page create
@endsection

@push('admin_style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>

@endpush

@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Page Create</h5>
                <small class="text-muted float-end"><a href="{{ route('page.index') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back page List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">


                        <label class="form-label mt-3" for="basic-default-fullname">Page Image</label>
                        <input type="file" class="dropify" data-height="200" name="page_img" data-default-file="" />



                        <label class="form-label mt-3" for="basic-default-fullname">Page Title</label>
                        <input type="text" class="form-control @error('page_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Page Title" name="page_title">

                        @error('page_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">Page Slug</label>
                        <input type="text" class="form-control @error('page_slug')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Page Slug" name="page_slug">

                        @error('page_slug')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">Meta Description</label>
                        <input type="text" class="form-control @error('meta_des')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Meta Description" name="meta_des">

                        @error('meta_des')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <label class="form-label mt-3" for="basic-default-fullname">Meta Key</label>
                        <input type="text" class="form-control @error('meta_key')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter Meta Key" name="meta_key">

                        @error('meta_key')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror


                        <div class="form-floating mt-3">
                            <textarea class="form-control"  id="page_short" style="height: 100px" name="page_short"></textarea>
                        </div>

                        <div class="form-floating mt-3">
                            <textarea class="form-control"  id="page_long" style="height: 200px" name="page_long"></textarea>
                        </div>



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


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector('#page_short') )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>

<script>
    ClassicEditor
            .create( document.querySelector('#page_long') )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );

</script>

@endpush
