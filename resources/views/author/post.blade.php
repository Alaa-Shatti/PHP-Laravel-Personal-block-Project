@extends('layouts.admin')

@section('title')
    Author Posts
@endsection

@section('content')

    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                Author Posts
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if(Auth::user()->comments->unique('post_id')->count() != 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <!-- User Posts -->
                            @foreach(Auth::user()->posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td class="text-nowrap"><a
                                            href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                    <td> {{ $post->comments->count() }} </td>
                                    <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans()  }}</td>

                                    <td>
                                        <a href=" {{route('postEdit', $post->id)}} " class="btn btn-warning">Edit</a>

                                        <form id="deletePost-{{ $post->id }}"
                                              action="{{ route('deletePost', $post->id) }}"
                                              method="POST">@csrf</form>
                                        <a href="#" class="btn btn-danger"
                                           onclick="document.getElementById('deletePost-{{ $post->id }}').submit()">
                                            Remove
                                        </a>
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
