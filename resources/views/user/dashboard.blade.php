@extends('layouts.admin')

@section('title')
    User Dashboard
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            @if(Auth::user()->posts->count() != 0)
                                <div>
                                    <span
                                        class="h4 d-block font-weight-normal mb-2">{{ Auth::user()->posts->count() }}</span>
                                    <span class="font-weight-light">My Posts</span>
                                </div>
                            @endif
                            @if(Auth::user()->posts->count() == 0)
                                <span>No Posts</span>
                            @endif

                            <div class="h2 text-muted">
                                <i class="icon icon-pencil"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            @if(Auth::user()->comments->count() != 0)
                                <div>
                                <span
                                    class="h4 d-block font-weight-normal mb-2">{{ Auth::user()->comments->count() }}</span>
                                    <span class="font-weight-light">My Comments</span>
                                </div>
                            @endif
                            @if(Auth::user()->comments->count() == 0)
                                <span>No Comments</span>
                            @endif

                            <div class="h2 text-muted">
                                <i class="icon icon-book-open"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            @if(Auth::user()->comments->unique('post_id')->count() != 0)
                                <div>
                                <span
                                    class="h4 d-block font-weight-normal mb-2">{{ Auth::user()->comments->unique('post_id')->count() }}</span>
                                    <span class="font-weight-light">Commented Posts </span>
                                </div>
                            @endif
                            @if(Auth::user()->comments->unique('post_id')->count() == 0)
                                <span>No Commented Posts</span>
                            @endif

                            <div class="h2 text-muted">
                                <i class="icon icon-paper-clip"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Comments by days
                        </div>

                        <div class="card-body p-0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection