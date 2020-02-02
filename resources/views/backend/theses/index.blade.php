@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('home'),
        'Tugas Akhir' => '#',
    ]) !!}
@endsection

@section('toolbar')
    {{-- {!! cui_toolbar_btn(route('admin.students.create'), 'icon-plus', 'Tambah Mahasiswa') !!} --}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-list "></i> List Tugas Akhir</strong>
                        @include('backend.theses._modal')
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{-- {{ $students->links() }} --}}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            {{-- <th class="text-center">Topik</th> --}}
                            <th class="text-center">Judul</th>
                            {{-- <th class="text-center">Deskripsi</th> --}}
                            <th class="text-center">Pembimbing</th>
                            {{-- <th class="text-center">Tanggal Mulai</th> --}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Administrasi</th>
                            <th class="text-center">Detail</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $n = 1?>
                        @foreach($theses as $thesis)
                                <tr>
                                    <td class="text-center">{{ $n }}</td>
                                    {{-- <td>{{ $thesis->topics_name }}</td> --}}
                                    <td class="text-center">{{ $thesis->title }}</td>
                                    {{-- <td class="text-center">{{ $thesis->abstract }}</td> --}}
                                    <td class="text-center">
                                        @foreach ($supervisors as $supervisor)
                                            @if ($supervisor->thesis_id == $thesis->id)
                                                {{$supervisor->lecturer_name}} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- <td class="text-center">{{ $thesis->start_at }}</td> --}}
                                    <td class="text-center">               
                                       @foreach ($t_statuses as $key => $val)                                           
                                            @if ($key == $thesis->status)
                                                {{ $val }}
                                            @endif
                                       @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group-vertical" role="group">
                                            <a class="btn btn-primary" href="{{route('student.ta_logbook.index', [$thesis->id])}}">Lihat Logbook</a>
                                            <a href="" class="btn btn-primary">Seminar Proposal</a>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{route('student.theses.show', [$thesis->id])}}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            <?php $n ++?>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $theses->links() }}
                            </div>
                        </div>
                    </div>
                    
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
