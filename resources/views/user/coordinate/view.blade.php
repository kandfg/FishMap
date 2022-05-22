@extends('layouts.app')

@section('content')
<div class="card-header">{{ __('檢視') }}</div>
    <div class="card-body">
    <table class="table table-bordered">
            <tr>
                <th class="table-dark">學名</th>
                <td>{{$coordinate->fishs->scientific_name}}</td>
                <td rowspan="8"><img src="{{$coordinate->images}}/{{$coordinate->images}}" alt="捕獲地點照片"></td>
            </tr>
            <tr>
                <th class="table-dark">名稱</th>
                <td>{{$coordinate->fishs->name}}</td>
            </tr>
            <tr>
                <th class="table-dark">捕獲日期</th>
                <td>{{$coordinate->survey_day}}</td>
            </tr>
            <tr>
                <th class="table-dark">捕獲人</th>
                <td>{{$coordinate->surveyor}}</td>
            </tr>
            <tr>
                <th class="table-dark">豐度</th>
                <td>{{$coordinate->abundance}}</td>
            </tr>
            <tr>
                <th class="table-dark">採集地點</th>
                <td>{{$coordinate->survey_place}}</td>
            <tr>
                <th class="table-dark">經度</th>
                <td>{{$coordinate->longitude}}</td>
            </tr>
            <tr>
                <th class="table-dark">緯度</th>
                <td>{{$coordinate->latitude}}</td>
            <tr>
            <tr>
                <th class="table-dark">資料上傳時間</th>
                <td>{{$coordinate->created_at}}</td>
            <tr>
    </table>
    <a class="btn btn-primary" href="{{ route('destory_coordinate') }}" role="button">刪除</a>
    <a class="btn btn-primary" href="{{ route('coordinate') }}" role="button">回上頁</a>
    
</div>
@endsection