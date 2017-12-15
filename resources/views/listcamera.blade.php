@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Danh sách Camera</h3>
                </div>
                <div class="clear"></div>
                <div class="clearfix container-fluid row">
                    <div id="filemanager">
                        <div class="clearfix container-fluid row">
                            @foreach ($list_camera as $camera)
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="panel widget center bgimage"
                                         style="margin-bottom:0;overflow:hidden;background-image:url('http://phap.zing.vn:8090/vendor/tcg/voyager/assets/images/widget-backgrounds/01.jpg');">
                                        <div class="dimmer"></div>
                                        <div class="panel-content">
                                            <i class="voyager-images"></i>
                                            <h4>{{$camera->name}}</h4>
                                            <p>{{$camera->description}}</p>
                                            <a href="{{route('camera_detail',['id'=> $camera->id])}}"
                                               class="btn btn-primary">Xem trực tiếp</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
