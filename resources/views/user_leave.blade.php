<div class="form-group">
    <select class="form-control" name="user">
        <option>Chọn nhân viên</option>
        @foreach($list_user as $user)
            <option value="{{$user['id']}}">{{$user['email']}}</option>
        @endforeach
    </select>
</div>