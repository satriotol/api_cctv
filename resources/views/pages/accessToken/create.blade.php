@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('candidate.index') }}">Candidates</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Candidate</li>
        </ol>
    </nav>

    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Candidate</h4>
                @include('partials.errors')
                <form
                    action="@isset($candidate) {{ route('candidate.update', $candidate->id) }} @endisset @empty($candidate) {{ route('candidate.store') }} @endempty"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($candidate)
                        @method('PUT')
                    @endisset
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="" required
                            value="{{ isset($candidate) ? $candidate->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="opd" class="form-label">OPD</label>
                        <input type="text" class="form-control" name="opd" id="" required
                            value="{{ isset($candidate) ? $candidate->opd : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="" rows="10" required>{{ isset($candidate) ? $candidate->description : '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">image</label>
                        <input type="file" class="form-control" name="image"
                            @empty($candidate) required @endempty accept="image/*"></input>
                    </div>
                    @isset($candidate)
                        <img src="{{ asset('uploads/' . $candidate->image) }}" height="100px">
                    @endisset
                    <div class="text-end">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
@endpush
