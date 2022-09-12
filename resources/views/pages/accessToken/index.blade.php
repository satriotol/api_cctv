@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('accessToken.index') }}">Token</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel Token</li>
        </ol>
    </nav>
    <div class="row mt-2">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Token</h6>
                    <div class="text-end">
                        <form action="{{ route('accessToken.store') }}" method="post">
                            @csrf
                            <input type="submit" value="Buat Token" class="btn btn-success" name="" id="">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Token</th>
                                    <th>Used</th>
                                    <th>Created At</th>
                                    <th>Last Used</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accessTokens as $accessToken)
                                    <tr>

                                        <td>
                                            {{ $accessToken->token }}
                                        </td>
                                        <td>
                                            {{ $accessToken->used }}
                                        </td>
                                        <td>
                                            {{ $accessToken->created_at }}
                                        </td>
                                        <td>
                                            {{ $accessToken->updated_at }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $accessTokens->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
