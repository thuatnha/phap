@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Lịch sử nhận diện</h3>
                </div>
                <div class="clear"></div>
                <div class="clearfix container-fluid row">
                    <div class="col-xs-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="User Name">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="filemanager">
                    <div class="clearfix container-fluid row">
                        @foreach ($list_file->items() as $file)
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="panel">
                                    <div class="panel-content text-center" style="overflow: hidden;background-size: cover;background-position: center center;position: relative;margin-bottom:0;height: 250px;background-image:url('{{ \Illuminate\Support\Facades\Storage::disk('public')->url($file['full_path']) }}')">
                                        <div class="panel-actions">
                                            <form action="{{route('history.action')}}" class="form-horizontal" METHOD="POST">
                                                {{ csrf_field() }}
                                                @include('listuser')
                                                <input type="hidden" name="full_path" value="{{$file['full_path']}}">
                                                <input type="hidden" name="file_name" value="{{$file['file_name']}}">
                                                <input type="hidden" name="id" value="{{$file['id']}}">
                                                <div class="form-inline form-group" style="margin-top: -15px;">
                                                    <button class="btn btn-primary" name="type" type="submit" value="move">Di Chuyển</button>
                                                    <button class="btn btn-warning" name="type" type="submit" value="delete">Xóa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item">Tên: {{$file['user_name']}} </li>
                                        <li class="list-group-item">Ngày:{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$file['updated_at'])->format('d/m/Y H:i:s')}}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clearfix container-fluid row">
                        <div class="col-md-12">
                            {{$list_file->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

    </style>
@stop
