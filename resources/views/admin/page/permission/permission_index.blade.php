@extends('admin.layout.master')
@section('title') permission @endsection
@push('admin_style')



@endpush

@section('index')

<div class="row">
    <div class="col">


<div class="card">

    <div class="d-flex justify-content-between align-items-center my-2">

        <h5 class="card-header">Permission Index / Permission List</h5>
        <a href="{{ route('permission.create') }}" class="btn btn-primary me-4"> <i class='bx bx-add-to-queue' ></i> Add New</a>

    </div>

    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Module Name</th>
            <th>Permission Name</th>
            <th>Permission Slug</th>
            <th>Last Update</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @forelse ($permission_data as $value)

            <tr>
                <td><strong>{{ $value->id }}</strong></td>
                <td>{{ $value->module->module_name ?? 'none'}}</td>
                <td>{{ $value->permission_name }}</td>
                <td>{{ $value->permission_slug }}</td>
                <td><span class="badge bg-label-primary me-1">{{ $value->updated_at->format('d-m-Y') }}</span></td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                      <a class="dropdown-item" href="{{ route('permission.edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                      <form action="{{ route('permission.destroy',$value->id) }}" method="post">
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

            {{ $permission_data->links() }}

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

    })

</script>

@endpush
