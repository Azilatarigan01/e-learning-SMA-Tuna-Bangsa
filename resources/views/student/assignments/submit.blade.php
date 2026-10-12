@extends('layouts.app')

@section('container')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Submit Assignment</h5>
        </div>
        <div class="card-body p-4">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('student.my_assignments.submit_assignments', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="inputDocument" class="form-label">Document<span style="color: red;">*</span></label>
                    <input type="file" class="form-control" name="document_file" required>
                    @error('document_file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputDescription" class="form-label">Description</label>
                    <textarea id="inputDescription" name="description" class="form-control" style="height: 300px">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
