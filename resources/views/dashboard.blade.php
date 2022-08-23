@extends('layout.master')

@push('plugin-styles')
    <!-- Plugin css import here -->
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header bg-success bg-gradient text-white">
                            <h4 class="text-uppercase">Total CCTV</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h2 class="mx-2">{{$data['cctv_total']}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header bg-primary bg-gradient text-white">
                            <h4 class="text-uppercase">Voting Count</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h2 class="mb-2">2</h2>
                                    {{-- <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>-2.8%</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header bg-danger bg-gradient text-white">
                            <h4 class="text-uppercase">Belum Voting</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h2 class="mb-2">3</h2>
                                    {{-- <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+2.8%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <canvas id="chartjsPie"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
@endpush

