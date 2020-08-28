@extends("layouts.app")

@section("content")


<h1>id={{$task->id}}のタスク詳細ページ</h1>

<div class="row col-8">
    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{$task->id}}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{$task->content}}</td>
        </tr>
        <tr>
            <th>ステータス</th>
            <td>{{$task->status}}</td>
        </tr>
    </table>
</div>

@if (Auth::id() == $task->user_id)
<div class='btn-group'>
    {!! link_to_route('tasks.edit', '編集',
        ['task' => $task->id], ['class' => 'btn btn-success']) !!}
</div>

<div class='btn-group'>
    {!! Form::model($task,['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class'=>'btn btn-danger']) !!}
    {!! Form::close() !!}   
</div>
@endif

@endsection


