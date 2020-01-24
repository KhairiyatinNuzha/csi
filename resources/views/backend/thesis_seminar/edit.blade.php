@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Thesis Seminar' => url('/thesis_seminar'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.semhas.create'), 'icon-plus', 'Tambah Semhas') !!}
    {!! cui_toolbar_btn(route('admin.semhas.index'), 'icon-list', 'Daftar Semhas') !!}

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            
                {{Form::model($semhas, ['route' => ['admin.semhas.update', $semhas->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) }}

                {{-- CARD HEADER --}}
                <div class="card-header">
                    Edit Data Semhas
                </div>

                {{-- CARD BODY --}}
                <div class="card-body">
                    @include('backend.thesis_seminar.edit_form')
                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary"/>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection