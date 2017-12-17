@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> Insert Camera</h3>
                </div>
                <div class="clear"></div>
                <div class="panel panel-bordered">
                    <form role="form" action="#"  method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="form-group">
                                <label >Camera Name <span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Camera Name">
                            </div>
                            <div class="form-group">
                                <label >Link Camera <span style="color: red">*</span></label>
                                <input type="text" name="link_camera" class="form-control" placeholder="Link Camera">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="5" name="description" class="form-control" placeholder="Description"></textarea>
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