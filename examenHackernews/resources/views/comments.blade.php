@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
          @if (count($errors))
            <div class = 'alert alert-danger'>
              <strong>Whoops! Something went wrong</strong>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }} </li>
                @endforeach
              </ul>
            </div>
          @endif

          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <div class = 'breadcrumb'>
            <a href = "{{route('/')}}"> ← back to overview</a>
          </div>

            <div class="panel panel-default">
                <div class="panel-heading space-between">Article: {{$article->title}}</div>

                <div class="panel-content">
                  @if(!(Auth::user()->id == $article->user_id))
                    <div class = 'vote'>
                      <div class = 'form-inline upvote'>
                        <i class = 'fa fa-btn fa-caret-up disabled upvote'></i>
                      </div>

                      <div class = 'form-inline downvote'>
                        <i class = 'fa fa-btn fa-caret-down disabled downvote'></i>
                      </div>
                    </div>

                    <div class = 'url'>
                      <a href = '{{ $article->url }}' class = 'urlTitle'> {{$article ->title}} </a>
                    </div>
                  @else
                    <div class = 'vote'>
                      <form class= 'form-inline upvote' action = "vote/up/{{ $article->id }}" method = 'POST'>
                        {{ csrf_field() }}
                        <button name = 'voteUp' value = "{{ $article->id }}">
                          <i class = 'fa fa-btn fa-caret-up' title = 'You need to be logged in to upvote'></i>
                        </button>
                      </form>

                      <form class= 'form-inline downvote' action = "vote/down/{{ $article->id }}" method = 'POST'>
                        {{ csrf_field() }}
                        <button name = 'voteDown' value = "{{ $article->id }}">
                          <i class = 'fa fa-btn fa-caret-down' title = 'You need to be logged in to upvote'></i>
                        </button>
                      </form>
                    </div>

                    <div class = 'url'>
                      <a href = '{{ $article->url }}' class = 'urlTitle'> {{$article ->title}} </a>
                    </div>
                  @endif

                  <div class = 'info'>
                    <div> {{ $article->votes}} points | posted  by {{$article->user->name}} | {{$article->comment->count()}}
                      @if ($article->comment->count() == 1)
                        comment
                      @else
                        comments
                      @endif
                    </div>
                  </div>

                  <div class = 'comments'>
                    @if($article->comment->count() > 0)
                      <ul>
                        @foreach ($article->comment as $comment)
                          <li>
                            <div class = 'comment-body'>{{ $comment -> body}}</div>
                            <div class = 'comment-info'>Poste by {{$comment -> user -> name}} on {{$comment -> created_at}}
                              @if(Auth::user()->id == $comment->user_id)
                                <a href = 'edit/{{ $comment->id }}' class = 'btn btn-primary btn-xs edit-btn'>edit</a>
                              @endif
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    @else
                      <div><p>No comments yet</p></div>
                    @endif

                    @guest
                      <div><p>You need to be <a href = "/login">logged in </a>to comment</p></div>

                    @else
                      <form class = 'form-horizontal' action = "insert/{{ $article->id }}" method = 'POST'>
                        {{ csrf_field() }}

                        <div class = 'form-group'>
                          <label class = 'col-sm-3 control-label' for = 'commentBody'>Comment</label>

                          <div class = 'col-sm-6'>
                            <textarea class = 'form-control' type = 'text' name = 'commentBody' id = 'commentBody'></textarea>
                          </div>
                        </div>
                        <div class = 'form-group'>
                          <div class = 'col-sm-offset-3 col-sm-6'>
                            <button class = 'btn btn-default' type = 'submit'>
                              <i class = 'fa fa-plus'></i>
                              Add comment
                            </button>
                          </div>
                        </div>
                      </form>
                    @endguest
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
