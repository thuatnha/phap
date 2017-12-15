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
                                <img src="">
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
                    console.log('end');
                })
            }
            function render_html(data) {
                var html = '';
                data.each(function(item){
                    console.log(item);
                })
            }
        });
    </script>
@endsection
