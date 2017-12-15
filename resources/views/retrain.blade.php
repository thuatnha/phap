@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Huấn luyện lại</h3>
                </div>
                <div class="clear"></div>
                <div class="clearfix container-fluid row">
                    <div class="col-xs-12">
                        @if(!$in_process)
                            <div class="well well-large">
                                <h4>Bạn có muốn thực hiện việc huấn luyện lại?</h4>

                                <form class="form-horizontal" method="post" action="{{route('retrain')}}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                    <a type="button" href="/admin" class="btn btn-danger">Hủy</a>

                                </form>
                            </div>
                        @else
                            <h4>Đang huấn luyện</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                    <span class="sr-only">0% Complete (success)</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop