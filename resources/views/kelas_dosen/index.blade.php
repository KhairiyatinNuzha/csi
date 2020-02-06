@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 align="center">Data Matkul</h2>                        
                    <a href="{{ route('kelaslecturer.tambah') }}" class="btn btn-primary btn-lg btn-block">Tambah dosen matkul</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama dosen</th>
                            <th>Kelas</th>
                        </tr>
                        @foreach($datas as $data)
                        <tr>
                            <td> {{ $data->name }} </td>
                            <td>
                                @foreach($data->classroom as $classroom)
                                <li>{{ $classroom->name }}</li>
                                @endforeach
                            </td> <!-- {{$data->lecturer}} -->
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
