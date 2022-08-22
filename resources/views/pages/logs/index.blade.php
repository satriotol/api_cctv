@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('log.index') }}">Logs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Logs</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Logs</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Voter / Phone</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->created_at }}</td>
                                        <td>
                                            {{ $log->voter->name ?? '-' }} / {{ $log->phone }}
                                        </td>
                                        <td>
                                            {{ $log->message }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @isset($log->voter)
                                                    <a onclick="sendWa({{ $log->voter->phone }})" href="#" class="mx-2">
                                                        <i class="link-icon text-success" data-feather="send"></i>
                                                    </a>
                                                @endisset
                                                <a onclick="del({{ $log->id }})" href="#" class="mx-2">
                                                    <i class="link-icon text-danger" data-feather="trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        function sendWa(phone) {
            const hp = "62" + phone.toString();
            // const slug = "{{ $log->voter->slug ?? null }}";
            const textMsg = "VOTING KORPRI : https://votingkorpri.semarangkota.go.id/" + hp;

            window.open("https://wa.me/" + hp + "?text=" + textMsg, "_blank");
        };

        function del(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
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
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('log.store') }}" + "/" + id,
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                data.msg,
                                'success'
                            ).then((result) => {
                                window.location.href = "{{ route('log.index') }}"
                            })
                        },
                    })
                }
            })
        }
    </script>
@endpush
