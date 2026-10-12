@extends('layouts.app')

@section('container')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Assignments List</h5>
        </div>
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="mb-0">Assignments List</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('teacher.assignments.add') }}" class="btn btn-primary">Add New Assignment</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center align-middle" style="min-width: 50px;">No</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 170px;">Class Name</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 190px;">Subject Name</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Assignments Date</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Submission Date</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Document</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 300px;">Description</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getRecord as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->class_name }}</td>
                            <td>{{ $record->subject_name }}</td>
                            <td>{{ date('d-m-Y', strtotime($record->assignments_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($record->submission_date)) }}</td>
                            <td>
                                @if($record->document_file)
                                    <a href="{{ asset('upload/assignments/' . $record->document_file) }}" download>{{ $record->document_file }}</a>
                                @else
                                    No Document
                                @endif
                            </td>
                            <td>{{ $record->description }}</td>
                            <td>
                                <div class="d-inline-flex justify-content-center">
                                    <a href="{{ route('admin.assignments.edit', $record->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.assignments.delete', $record->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
