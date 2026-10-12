@extends('layouts.app')

@section('container')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Edit Exam</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('exam_update', $record->id) }}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="mb-3">
                    <label for="inputName" class="form-label">Exam Name</label>
                    <input type="text" class="form-control" value="{{ $record->name }}" name="name" required placeholder="Exam Name">
                </div>
                <div class="mb-3">
                    <label for="inputNote" class="form-label">Note</label>
                    <textarea class="form-control" name="note" name="name" required placeholder="Note">{{ $record->note }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
