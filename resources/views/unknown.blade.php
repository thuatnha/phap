@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Không thể nhận diện</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <div class="clearfix container-fluid row">
                        @foreach ($list_file as $file)
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="panel">
                                    <div class="panel-content text-center" style="overflow: hidden;background-size: cover;background-position: center center;position: relative;margin-bottom:0;height: 250px;background-image:url('{{ \Illuminate\Support\Facades\Storage::disk('public')->url($file['full_path']) }}')">
                                        <div class="panel-actions" style="display: block;">
                                            <form action="{{route('unknown.action')}}" METHOD="POST">
                                                {{ csrf_field() }}
                                                @include('listuser')
                                                <input type="hidden" name="full_path" value="{{$file['full_path']}}">
                                                <input type="hidden" name="file_name" value="{{$file['file_name']}}">
                                                <button class="btn btn-primary" name="type" type="submit" value="move">Di Chuyển</button>
                                                <button class="btn btn-warning" name="type" type="submit" value="delete">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        {{--<li class="list-group-item">Tên: {{$file['user']}} </li>--}}
                                        <li class="list-group-item">Ngày: {{\App\Utils\Convert::convert_date_time($file['date_time'], 'd/m/Y H:i:s')}}</li>
                                        {{--<li class="list-group-item">Giờ: {{\App\Utils\Convert::convert_date_time($file['date_time'], 'H:i:s')}}</li>--}}
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

    </style>
@stop
