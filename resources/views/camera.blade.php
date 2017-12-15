@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Camera {{$camera['name']}}</h3>
                </div>
                <div class="clear"></div>
                <div class="clearfix container-fluid row">
                    <div id="filemanager">
                        <div class="clearfix container-fluid row">
                            <div class="col-md-5">
                                <img src="{{$camera['link_camera']}}">
                            </div>
                            <div class="col-md-7">
                                <table class="table table-hover" id="table-camera">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            get_history();
            function get_history(){
                $.get( "/admin/camera-train" ).then(function(data){
                    render_html(data);
                }).then(function(){
                    setTimeout(function(){
                        get_history();
                    },3000);

                })
            }
            function render_html(data) {
                var html = '';
                data = JSON.parse(data);
                $.each(data, function(index,camera){
                    html += '<tr><td>'+ camera.user_name + '</td><td>'+  camera.updated_at + '</td></tr>';
                })
                $('#table-camera tbody').html(html);
            }
        });
    </script>
@endsection
