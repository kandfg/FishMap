@extends('layouts.app')

@section('content')
<div class="card-header">{{ __('檢視') }}</div>
    <div class="card-body">
    <table class="table table-bordered">
            <tr>
                <th class="table-dark">學名</th>
                <td>{{$coordinate->fishs->scientific_name}}</td>
                <th class="table-dark">名稱</th>
                <td>{{$coordinate->fishs->name}}</td>
            </tr>
            <tr>
                <th class="table-dark">捕獲日期</th>
                <td>{{$coordinate->survey_day}}</td>
                <th class="table-dark">捕獲人</th>
                <td>{{$coordinate->surveyor}}</td>
            </tr>
            <tr>
                <th class="table-dark">豐度</th>
                <td>{{$coordinate->abundance}}</td>
                <th class="table-dark">採集地點</th>
                <td>{{$coordinate->survey_place}}</td>
            </tr>
                <th class="table-dark">經度</th>
                <td>{{$coordinate->longitude}}</td>
                <th class="table-dark">緯度</th>
                <td>{{$coordinate->latitude}}</td>
            </tr>
            <tr>
                <th class="table-dark">上傳時間</th>
                <td colspan=3>{{$coordinate->created_at}}</td>
            <tr>
            <tr>
                <td colspan=4><img src="{{$coordinate->images}}/{{$coordinate->images}}" alt="捕獲地點照片"></td>
            </tr>
    </table>
    <form action="{{ route('destory_coordinate',$coordinate->id) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-primary" type="submit">刪除</button>
        <a class="btn btn-primary" href="{{ route('coordinate') }}" role="button">回上頁</a>
    </form>
    
</div>
@endsection