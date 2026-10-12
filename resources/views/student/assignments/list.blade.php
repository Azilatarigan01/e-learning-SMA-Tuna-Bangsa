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
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center align-middle">
                     <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center align-middle" style="min-width: 50px;">No</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 170px;">Class Name</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 190px;">Subject Name</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Assignments Date</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Submission Date</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Document</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Description</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Created By</th>
                            <th scope="col" class="text-center align-middle" style="min-width: 200px;">Action</th>
                        </tr>
                    </thead>                   
                    <tbody>
                        @foreach ($getRecord as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->class->name }}</td>
                            <td>{{ $record->subject->name }}</td>
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
                            <td>{{ $record->user->name }}</td>
                            <td>
                                <!-- Tambahkan aksi pengiriman tugas untuk mahasiswa -->
                                <form action="{{ route('student.my_assignments.submit_assignments', $record->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Submit Assigments</button>
                                </form>
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
