@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('座標') }}</div>
    <div class="card-body">
        <div name="coordinate">
            <div name="create">
                <p>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    創建座標
                </button>
                </p>
                <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="{{ route('create_coordinate') }}" method="post">
                        @csrf
                        <selfish></selfish>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">勘查者</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="surveyor">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">捕獲方式</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="survey_method">
                            <span class="input-group-text" id="inputGroup-sizing-default">勘查時數</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="survey_hours">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">捕獲日期</span>
                            <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="survey_day">
                            <span class="input-group-text" id="inputGroup-sizing-default">捕獲數量</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="abundance">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">採集地點</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="survey_place">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">緯度</span>
                            <input type="text" id="longitude"id="latitude" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="latitude">
                            <span class="input-group-text" id="inputGroup-sizing-default">經度</span>
                            <input type="text" id="latitude" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="longitude">
                            <gecord></gecord>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">圖片</label>
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                        <button type="submit" class="btn btn-primary">建立</button>
                        
                    </form>
                </div>
                </div>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>魚類名稱</th>
                        <th>捕獲日期</th>
                        <th>資料上傳時間</th>
                        <th>檢視</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fishCoordinates as $fishCoordinate)
                    <tr>
                        <td>{{ $loop->index +1}}</td>
                        <td>{{$fishCoordinate->fishs->name}}</td>
                        <td>{{$fishCoordinate->survey_day}}</td>
                        <td>{{$fishCoordinate->created_at}}</td>
                        <td>
                            <form action="{{ route('show_coordinate', $fishCoordinate->id)}}" method="get">
                                <button class="btn btn-primary" type="submit">檢視</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        <div>
    </div>
    </div>
</div>
@endsection