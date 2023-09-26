<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>{{ $page->page_title }}</title>
</head>
<body>

    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0 m-auto my-5" >

            <div class="card" style="width: 40rem;">
                <img src="{{ asset('uploads/pages_img') }}/{{ $page->page_img }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $page->page_title }}</h5>
                  <p class="card-text">{!! $page->page_short !!}</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>


        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
