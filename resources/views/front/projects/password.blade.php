<form action="{{route('project.confirm',$project)}}" method="POST">
    @csrf
    <input type="password" name="password" id="">
    <button type="submit">تأكيد</button>
</form>