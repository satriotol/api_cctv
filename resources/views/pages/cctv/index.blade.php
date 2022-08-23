@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://vjs.zencdn.net/7.20.2/video-js.css" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cctv.index') }}">CCTV</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tabel CCTV</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total CCTV</h6>
            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{ $datas['total_cctv'] }}</h3>
                    <div class="d-flex align-items-baseline">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">CCTV</h6>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kecamatan</label>
                                <select class="js-example-basic-single form-select" name="kecamatan_search"
                                    data-width="100%">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->nama_kecamatan }}"
                                            @if (old('kecamatan_search') == $kecamatan->nama_kecamatan) selected @endif>
                                            {{ $kecamatan->nama_kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Kelurahan</label>
                                <select class="js-example-basic-single form-select" name="kelurahan_search"
                                    data-width="100%">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($kelurahans as $kelurahan)
                                        <option value="{{ $kelurahan->nama_kelurahan }}"
                                            @if (old('kelurahan_search') == $kelurahan->nama_kelurahan) selected @endif>
                                            {{ $kelurahan->nama_kelurahan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Url</label>
                                <select class="js-example-basic-single form-select" name="status_search" data-width="100%">
                                    <option value="">Pilih Status</option>
                                    <option value="1" @if (old('status_search') == '1') selected @endif>
                                        Hidup
                                    </option>
                                    <option value="0" @if (old('status_search') == '0') selected @endif>
                                        Mati
                                    </option>
                                </select>
                            </div>
                            <div class="text-end">
                                <input type="submit" value="Cari" class="btn btn-primary" id="">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Status</th>
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
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $cctv->id }}">
                                                Edit
                                            </button>
                                            <div class="modal fade" id="exampleModal{{ $cctv->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ $cctv->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="btn-close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('cctv.update', $cctv->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="">Pilih Status</option>
                                                                        <option value="1"
                                                                            @if ($cctv->status == '1') selected @endif>
                                                                            Hidup</option>
                                                                        <option value="0"
                                                                            @if ($cctv->status == '0') selected @endif>
                                                                            Mati</option>
                                                                    </select>
                                                                </div>
                                                                <div class="text-end mt-2">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button class="btn btn-primary" type="submit">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $cctv->status ?? 'Belum Terdata' }}
                                        </td>
                                        <td>
                                            {{ $cctv->kecamatan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cctv->kelurahan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cctv->rw }}/{{ $cctv->rt }}
                                        </td>
                                        <td>
                                            @if ($cctv->liveViewUrl)
                                                <a href="{{ $cctv->liveViewUrl }}"
                                                    target="_blank">{{ $cctv->liveViewUrl }}</a>
                                            @else
                                                Tidak Ada Url
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $cctvs->render() !!}
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
