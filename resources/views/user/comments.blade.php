@extends('layouts.admin')

@section('title')
    User Comments
@endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                User Comments
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if(Auth::user()->comments->unique('post_id')->count() != 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post</th>
                                <th>Content</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <!-- User comments -->
                            @foreach(Auth::user()->comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>

                                    <!-- note: comment->post_id-->
                                    <td class="text-nowrap"><a

                                            href="{{ route('singlePost', $comment->post_id) }}">{{ $comment->post->title }}</a>

                                    </td>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans()  }}</td>
                                    <td>
                                        <form id="deleteComment-{{ $comment->id }}"
                                              action="{{ route('deleteComments', $comment->id) }}"
                                              method="POST">@csrf</form>
                                        <button type="button" class="btn btn-danger"
                                                onclick="document.getElementById('deleteComment-{{ $comment->id }}').submit()">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if(Auth::user()->comments->unique('post_id')->count() == 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                No Comments
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
