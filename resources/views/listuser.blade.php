<select class="form-control" name="user">
    <option>Chọn nhân viên</option>
    @foreach($list_user as $user)
        <option value="{{$user['email']}}">{{$user['email']}}</option>
    @endforeach
</select>