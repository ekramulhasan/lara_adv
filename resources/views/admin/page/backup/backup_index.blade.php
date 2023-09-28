@extends('admin.layout.master')
@section('title') backupup Data @endsection
@push('admin_style')



@endpush

@section('index')

<div class="row">
    <div class="col">


<div class="card">

    <div class="d-flex justify-content-between align-items-center my-2">

        <h5 class="card-header">Backup Index / Backup List</h5>
        {{-- <a href="{{ route('backup.create') }}" class="btn btn-primary me-4">Add New</a> --}}

        <button type="button" class="btn btn-primary me-4" onclick="event.preventDefault(); document.getElementById('data_store').submit();">Create Backup</button>
        <form action="{{ route('backup.store') }}" method="post" class="d-none" id="data_store">
            @csrf

        </form>

    </div>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>File Name</th>
            <th>File Size</th>
            <th>Created Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @forelse ($backup as $value)

            <tr>
                <td><strong>{{ $loop->index+1 }}</strong></td>
                <td>{{ $value['file_name'] }}</td>
                <td>{{ $value['file_size'] }}</td>
                <td>{{ $value['create_at'] }}</td>

            <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" style="">

                      <a class="dropdown-item" href="{{ route('backup.download',$value['file_name']) }}"><i class="bx bx-download me-1"></i> Download</a>




                        <form action="{{ route('backup.destroy',$value['file_name']) }}" method="post">
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
{{--
      <div class="my-2 p-3">
        {{ $backup_data->links() }}
      </div> --}}

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
                url: "/admin/backup_isactive/"+item_id,
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
