@extends('layouts.app')

@section('container')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Add New Assignment</h5>
        </div>
        <div class="card-body p-4">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('teacher.assignments.insert') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="class_id" class="form-label">Class</label>
                    <select class="form-control" name="class_id" id="class_id" required>
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select class="form-control" name="subject_id" id="subject_id" required>
                        <option value="">Select Subject</option>
                        @foreach ($getSubject as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror                
                </div>
                
                <div class="mb-3">
                    <label for="assignments_date" class="form-label">Assignments Date<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" value="{{ old('assignments_date') }}" name="assignments_date" required>
                    @error('assignments_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="submission_date" class="form-label">Submission Date<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" value="{{ old('submission_date') }}" name="submission_date" required>
                    @error('submission_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="document_file" class="form-label">Document</label>
                    <input type="file" class="form-control" name="document_file" required>
                    @error('document_file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" style="height: 300px">{{ old('description') }}</textarea>
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
