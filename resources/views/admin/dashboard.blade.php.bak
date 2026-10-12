@extends('layouts.app')

@section('container')
<div class="container my-4">
  <div class="card text-center mt-4">
    <div class="card-header">
      Dashboard
    </div>
    <div class="card-body">
      <h5 class="card-title">Selamat Datang Admin</h5>
      <p class="card-text">Di SMA Tuna Bangsa</p>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
    <div class="col">
      <div class="card card-clickable" onclick="location.href='/admin/class/list'">
        <img src="{{ asset('assets/img/kelas.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Class</h5>
          <p class="card-text">Kelola data kelas di sini.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-clickable" onclick="location.href='/admin/teacher/list'">
        <img src="{{ asset('assets/img/guru.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Teacher</h5>
          <p class="card-text">Kelola data Guru di sini.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-clickable" onclick="location.href='/admin/student/list'">
        <img src="{{ asset('assets/img/student.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Student</h5>
          <p class="card-text">Kelola data siswa di sini.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-clickable" onclick="location.href='/admin/subject/list'">
        <img src="{{ asset('assets/img/subject.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Subject</h5>
          <p class="card-text">Kelola data mata pelajaran di sini.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-clickable" onclick="location.href='{{ route('admin.homework.list') }}'">
        <img src="{{ asset('assets/img/tugas.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Homework</h5>
          <p class="card-text">Kelola data tugas di sini.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-clickable" onclick="location.href='/admin/examinations/exam/list'">
        <img src="{{ asset('assets/img/penilaian.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Exam</h5>
          <p class="card-text">Kelola data Exam di sini.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
