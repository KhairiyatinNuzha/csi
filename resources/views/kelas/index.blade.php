@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2 align="center">Data Kelas</h2>                        
                    <a href="{{ route('kelas.tambah') }}" class="btn btn-primary btn-lg btn-block">Tambah Matkul</a>

                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Kode Matkul</th>
                            <th>Semester</th>
                            <th>Detail</th>
                        </tr>
                        @foreach($datas as $kelas)
                        <tr>
                            <td> {{ $kelas->name }} </td>
                            <td> {{ $kelas->course->code }} </td>
                            <td> {{ $kelas->semester->period }} </td>
                            <td>
                                
                                <a href="{{ route('kelas.edit',[$kelas->id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('kelas.delete',[$kelas->id]) }}" class="btn btn-danger">Hapus</a>
                                <a href="{{ route('kelas.detail',[$kelas->id]) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
