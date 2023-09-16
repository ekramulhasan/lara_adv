@extends('admin.layout.master')
@section('title')
    edit role
@endsection


@section('index')

<div class="row">

    <div class="col">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Role Edit</h5>
                <small class="text-muted float-end"><a href="{{ route('role.index') }}" class="btn btn-primary"> <i class='bx bx-left-arrow-alt'></i> Back Role List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('role.update',$role_data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Role Name</label>
                        <input type="text" class="form-control @error('role_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter role Name" name="role_name" value="{{ $role_data->role_name }}">

                        @error('role_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Role Note</label>
                        <input type="text" class="form-control @error('role_name')
                            is-invalid

                        @enderror" id="basic-default-fullname" placeholder="Enter role Note" name="role_note" value="{{ $role_data->role_note }}">

                        @error('role_note')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mt-4 mb-2">

                        <span><strong>Manage Permissions for Role</strong></span>

                    </div>

                    <div class="form-check justify-content-center mb-3">
                        <input class="form-check-input" type="checkbox" id="select-all"> Select All
                      </div>

                    <div class="my-4">

                    @foreach ($module_data->chunk(2) as $key => $chunks)


                        <div class="row">



                            @foreach ($chunks as $value)

                                <div class="col">

                                    <h5 class="text-primary">Module: {{ $value->module_name }}</h5>

                                    {{-- select permission --}}



                                        @foreach ($value->permissions as $item)

                                        <div class="form-check justify-content-center mb-3">
                                            <input class="form-check-input"
                                            type="checkbox"
                                            value="{{ $item->id }}"
                                            name="items[]"
                                            id="permission-{{ $item->id }}"

                                                @foreach ($role_data->permissions as $r_permission)
{{--
                                                    @if ($r_permission->id == $item->id)
                                                        {{ 'checked' }}
                                                    @endif --}}

                                                    {{ $r_permission->id == $item->id ? 'checked': '' }}


                                                @endforeach


                                            > {{ $item->permission_name }}
                                        </div>

                                        @endforeach


                                </div>

                            @endforeach



                        </div>

                    @endforeach



                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>



    </div>
</div>

@endsection

@push('admin_script')

<script>

    $('#select-all').click(function(event) {

        if (this.checked) {

            $(':checkbox').each(function() {

                this.checked = true;

            })

        }

        else{

            $(':checkbox').each(function() {

            this.checked = false;

            })

        }

    })

</script>


@endpush
