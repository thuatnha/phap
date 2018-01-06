@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Đăng ký nghĩ phép</h3>
                </div>
                <div class="clear"></div>
                <div class="panel panel-bordered">
                    <form role="form" action="#" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            @include('user_leave')
                            <div class="form-group">
                                <label>Từ Ngày <span style="color: red">*</span></label>
                                <input type="text" name="from_date" class="form-control" placeholder="Từ ngày">
                            </div>
                            <div class="form-group">
                                <label>Đến Ngày <span style="color: red">*</span></label>
                                <input type="text" name="to_date" class="form-control" placeholder="Đến ngày">
                            </div>
                            <div class="form-group">
                                <label>Lý do</label>
                                <textarea rows="5" name="description" class="form-control"
                                          placeholder="Lý do nghĩ phép"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Insert</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(function() {
            $('input[name="from_date"],input[name="to_date"]').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                singleDatePicker: true,
            });
        })
    </script>
@endsection