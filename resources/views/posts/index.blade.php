@extends('layouts.login')

@section('content')

<img src="{{ asset('images/icon1.png') }}" alt="{{ Auth::user()->username }}のアイコン">
<div class="container">
    <!-- エラーメッセージ表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' => '/top']) !!}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) }}
    </div>
    <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="送信"></button>
    {!! Form::close() !!}
</div>
<div>
    @foreach($list as $item)
        <tr>
            <td>{{ $item->user->username }}</td>
            <td>{{ $item->post }}</td>
            <td>{{ $item->created_at }}</td>
            <!-- 編集ボタン -->
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPostModal{{ $item->id }}">
                    <img src="/images/edit.png" alt="編集" onclick="submitEditForm({{ $item->id }})" style="cursor: pointer;">
                </button>
                <!-- 削除ボタン -->
                <a href="{{ route('post.destroy', ['id' => $item->id]) }}" onclick="return confirm('本当に削除しますか？')">
                <img src="{{ asset('/images/trash-h.png') }}" alt="削除" class="trash-icon" onmouseover="this.src='{{ asset('/images/trash.png') }}'" onmouseout="this.src='{{ asset('/images/trash-h.png') }}'">
            </a>
            </td>
        </tr>

        <!-- Edit Post Modal -->
        <div class="modal fade" id="editPostModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        {!! Form::open(['url' => '/top/update']) !!}
                        {{ Form::token() }}
                        {{ Form::hidden('postId', $item->id) }}
                        <div class="form-group">
                            {{ Form::textarea('editedPost', $item->post, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください', 'rows' => 4, 'maxlength' => 150]) }}
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitEditForm({{ $item->id }})">保存</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- JavaScript -->
<script>
    function submitEditForm(postId) {
        // モーダル内のフォームをサブミット
        var formId = 'form#editForm' + postId;
        $(formId).submit();
    }
</script>

@endsection
