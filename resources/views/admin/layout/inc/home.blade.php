@extends('admin.layout.master')
@section('title') login activity @endsection

@push('admin_style')

@endpush

@section('index')

<div class="row">

    <div class="col-lg-4 col-md-4 col-4 mb-4">

        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total User</span>
            <h3 class="card-title mb-2">{{ $user_count }}</h3>

          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-4 mb-4">

        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Role</span>
            <h3 class="card-title mb-2">{{ $role_count }}</h3>

          </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-4 mb-4">

        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Total Page</span>
            <h3 class="card-title mb-2">{{ $page_count }}</h3>

          </div>
        </div>
    </div>
</div>

<div class="row">
   <div class="col-12">

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>User ID</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>Last Activity</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

              @forelse ($user_data as $value)

              <tr>
                  <td><strong>{{ $value->id }}</strong></td>
                  <td>{{ $value->user_id }}</td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->email }}</td>
                  <td><span class="badge bg-label-primary me-1">{{ $value->created_at->format('d-m-Y') }} / {{ $value->created_at->diffForHumans() }}</span></td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" style="">

                        <a class="dropdown-item" href="{{ route('user.edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>




                          <form action="{{ route('user.destroy',$value->id) }}" method="post">
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
          {{ $user_data->links() }}
        </div>

    </div>

   </div>
</div>

@endsection


@push('admin_script')

@endpush
