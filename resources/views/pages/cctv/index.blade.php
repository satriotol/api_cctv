@extends('layout.master')

@push('plugin-styles')
    <link href="https://vjs.zencdn.net/7.20.2/video-js.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cctv.index') }}">CCTV</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel CCTV</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">CCTV</h6>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Kecamatan</label>
                                <input type="text" class="form-control" placeholder="Cari Kecamatan"
                                    name="kecamatan_search" id="">
                            </div>
                            <div class="col-md-6">
                                <label>Kelurahan</label>
                                <input type="text" class="form-control" placeholder="Cari Kelurahan"
                                    name="kelurahan_search" id="">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>RW/RT</th>
                                    <th>Live Url</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cctvs as $cctv)
                                    <tr>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('cctv.edit', $cctv->id_lokasi) }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('cctv.destroy', $cctv->id_lokasi) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            {{ $cctv->kelurahan->kecamatan->nama_kecamatan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cctv->kelurahan->nama_kelurahan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cctv->rw }}/{{ $cctv->rt }}
                                        </td>
                                        <td>
                                            @if ($cctv->cameraUrl)
                                                <a href="{{ $cctv->cameraUrl }}" target="_blank">{{ $cctv->cameraUrl }}</a>
                                            @else
                                                Tidak Ada Url
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $cctvs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
