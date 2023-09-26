@extends('admin.layout.master')
@section('title') page @endsection
@push('admin_style')



@endpush

@section('index')

<div class="row">
    <div class="col">


<div class="card">

    <div class="d-flex justify-content-between align-items-center my-2">

        <h5 class="card-header">Page Index / Page List</h5>
        <a href="{{ route('page.create') }}" class="btn btn-primary me-4">Add New</a>

    </div>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Page Title</th>
            <th>Meta Title</th>
            <th>Meta Keys</th>
            <th>Create Date</th>
            <th>Active/Inactive</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @forelse ($page_data as $value)

            <tr>
                <td><strong>{{ $value->id }}</strong></td>
                <td>{{ $value->page_title }}</td>
                <td>{{ $value->meta_description }}</td>
                <td>{{ $value->meta_key }}</td>
                <td><span class="badge bg-label-primary me-1">{{ $value->created_at->format('d-m-Y') }}</span></td>
                <td>

                    <div class="form-check form-switch">

                        <input class="form-check-input toggle-class" type="checkbox" role="switch" data-id="{{ $value->id }}" id="page-{{ $value->id }}" {{ $value->is_active ? 'checked':'' }}>

                    </div>


                </td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" style="">

                      <a class="dropdown-item" href="{{ route('page.edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>




                        <form action="{{ route('page.destroy',$value->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item show_confirm" ><i class="bx bx-trash me-1"></i> Delete</button>

                        </form>

                    </div>
                  </div>
                </td>
              </tr>

            @empty

            @endforelse



        </tbody>
      </table>

      <div class="my-2 p-3">
        {{ $page_data->links() }}
      </div>

    </div>
  </div>



    </div>
</div>


@endsection

@push('admin_script')

<script>

    $(document).ready(function(){

        $('.show_confirm').click(function(event){

            let form = $(this).closest('form');
            event.preventDefault();

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {

                form.submit();

                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

        })


        $('.toggle-class').change(function () {

            var is_active = $(this).prop('checked') == true ? 1 : 0;
            var item_id = $(this).data('id');

            // console.log(is_active, item_id);

            $.ajax({

                type: "GET",
                url: "/admin/page_isactive/"+item_id,
                dataType: "json",
                success: function (response) {

                    console.log(response);
                    Swal.fire(
                        response.message,
                        response.type
                    )

                },
                error: function (err) {

                    console.log(err);
                    Swal.fire(

                        'not permission 404 error'

                    )
                }
            });

        });

    })

</script>

@endpush
