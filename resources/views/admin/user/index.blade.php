@extends('app')

@section('title', 'Data User')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm btn-edit" href="#" data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a class="btn btn-danger btn-sm btn-delete" href="#" data-id="{{ $item->id }}">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.user.edit')
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $("#userTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            })
        })

        $('.btn-delete').on('click', function () {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Apa anda yakin untuk menghapus ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777ef',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/users/${id}`,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success === true) {
                                Swal.fire("Done!", response.message, "success");
                                location.reload();
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        }
                    });
                }
            })
        })

        $('.btn-edit').on('click', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/users/" + id + "/edit",
                type: "GET",
                success: function (response) {
                    $('#namaEdit').val(response.name);
                    $('#emailEdit').val(response.email);
                    $('#userFormEdit').attr('action', `/users/${response.id}`);

                    $('#modalEdit').modal('show');
                }
            })
        })

        // check btn sumbit
        $('#userFormEdit').on('submit', function (e) {
            var password = $('#passwordEdit').val();
            var passwordconfirm = $('#passwordconfirmEdit').val();

            if (password) {
                if (password !== passwordconfirm) {
                    $('#passwordconfirmEdit').addClass('is-invalid');
                    $('#passwordEdit').addClass('is-invalid');

                    return false;
                }
            }
        })
    </script>
@endpush
