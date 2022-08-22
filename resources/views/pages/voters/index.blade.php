@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('voter.index') }}">Voter</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Voter</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Voter</h6>
                    <div class="text-end mb-2">
                        <a class="btn btn-primary" href="{{ route('voter.create') }}">
                            <i data-feather="plus"></i>
                            Create
                        </a>
                    </div>
                    <form action="" method="GET">
                        <div class="form-group">
                            <select name="candidate_search" class="form-control" id="">
                                <option @if (old('candidate_search') == '') selected @endif value="">Pilih Status
                                </option>
                                <option @if (old('candidate_search') == 'sudah') selected @endif value="sudah">Sudah</option>
                                <option @if (old('candidate_search') == 'belum') selected @endif value="belum">Belum</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Phone</th>
                                    <th>Candidate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voters as $voter)
                                    <tr>
                                        <td>
                                            {{ $voter->name }}
                                        </td>
                                        <td>
                                            {{ $voter->slug }}
                                        </td>
                                        <td>
                                            {{ $voter->phone }}
                                        </td>
                                        <td>
                                            @if (isset($voter->candidate->name))
                                                {{ $voter->candidate->name }}
                                            @else
                                                {!! '<span class="badge rounded-pill bg-danger">-</span>' !!}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a onclick="sendWa({{ $voter->id }})" href="#" class="mx-2">
                                                    <i class="link-icon text-success" data-feather="send"></i>
                                                </a>
                                                <a href="{{ route('voter.edit', $voter->id) }}" class="mx-2">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                </a>
                                                <a onclick="del({{ $voter->id }})" href="#" class="mx-2">
                                                    <i class="link-icon text-danger" data-feather="trash-2"></i>
                                                </a>
                                                <a onclick="sendWeb({{ $voter->phone }})" href="#"
                                                    class="mx-2 text-success">
                                                    {{-- <h3><i class="mdi mdi-whatsapp"></i></h3> --}}
                                                    <svg style="width:25px;height:25px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z" />
                                                    </svg>
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
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        function sendWeb(phone) {
            const hp = "62" + phone.toString();
            // const slug = "{{ $log->voter->slug ?? null }}";
            const textMsg = "VOTING KORPRI : https://votingkorpri.semarangkota.go.id/0" + phone;
            window.open("https://wa.me/" + hp + "?text=" + textMsg, "_blank");
        };

        function sendWa(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: 'GET',
                url: "/api/singleWhatsapp" + "/" + id,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait!',
                        html: 'Sending Link...',
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                },
                success: function(data) {
                    Swal.fire(data.meta.message);
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal mengirim link',
                        text: data.responseJSON.meta.message
                    });
                    return;
                },
                complete: function() {
                    Swal.hideLoading();
                }
            })
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
                        url: "{{ route('voter.store') }}" + "/" + id,
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                data.msg,
                                'success'
                            ).then((result) => {
                                window.location.href = "{{ route('voter.index') }}"
                            })
                        },
                    })
                }
            })
        }
    </script>
@endpush
