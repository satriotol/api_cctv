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
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">CCTV</h6>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Kecamatan</label>
                                <select class="js-example-basic-single form-select" name="kecamatan_search"
                                    data-width="100%">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id_kecamatan }}"
                                            @if (old('kecamatan_search') == $kecamatan->id_kecamatan) selected @endif>
                                            {{ $kecamatan->nama_kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Kelurahan</label>
                                <select class="js-example-basic-single form-select" name="kelurahan_search"
                                    data-width="100%">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($kelurahans as $kelurahan)
                                        <option value="{{ $kelurahan->id_kelurahan }}"
                                            @if (old('kelurahan_search') == $kelurahan->id_kelurahan) selected @endif>
                                            {{ $kelurahan->nama_kelurahan }}
                                        </option>
                                    @endforeach
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
                                                <a href="{{ $cctv->cameraUrl }}"
                                                    target="_blank">{{ $cctv->cameraUrl }}</a>
                                            @else
                                                Tidak Ada Url
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
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
