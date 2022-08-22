@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('voter.index') }}">Voter</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Voter</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Voter</h4>
                @include('partials.errors')
                <form
                    action="@isset($voter) {{ route('voter.update', $voter->id) }} @endisset @empty($voter) {{ route('voter.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($voter)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" required class="form-control" id=""
                            value="{{ isset($voter) ? $voter->name : @old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" required class="form-control" id=""
                            value="{{ isset($voter) ? $voter->phone : @old('phone') }}">
                    </div>
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
