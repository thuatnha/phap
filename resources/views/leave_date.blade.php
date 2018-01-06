@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-camera"></i>
        Nghĩ phép
    </h1>
    <a href="{{route('create_leave_date')}}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>Đăng ký phép</span>
    </a>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nhân viên</th>
                                    <th>Từ ngày</th>
                                    <th>Đến ngày</th>
                                    <th>Lý do</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(empty($list_leave))
                                    <tr>
                                        <td colspan="4"> Không có dữ liệu</td>
                                    </tr>
                                @else
                                    @foreach($list_leave as $item)
                                        <tr>
                                            <td>{{$item->users[0]->email}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->from_date)->format('d/m/Y')}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->to_date)->format('d/m/Y')}}</td>
                                            <td>{{$item->description}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix container-fluid row">
                            <div class="col-md-12">
                                {{$list_leave->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection