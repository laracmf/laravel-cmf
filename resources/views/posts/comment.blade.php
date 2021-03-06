@if((commentOwner($comment->user_id) && !$comment->approved) || $comment->approved || !config('app.moderation'))
    <div id="comment_{!! $comment->id !!}"
         class="well clearfix col-xs-12 animated bounceIn{!! rand(0, 1) ? 'Left': 'Right' !!}"
         data-pk="{!! $comment->id !!}" data-ver="{!! $comment->version !!}">
        @if(isRole('moderator') || commentOwner($comment->user_id))
            <div class="col-md-9 col-sm-8">
                <p><strong>{!! $comment->author !!}</strong>
                    - {!! html_ago($comment->created_at, 'timeago_comment_'.$comment->id) !!} @if(!$comment->approved && config('app.moderation'))
                        <i>Pending moderator approving</i> @endif</p>
                <p id="main_comment_{!! $comment->id !!}" class="main">{!! nl2br(e($comment->body)) !!}</p>
            </div>
            <div class="hidden-xs">
                <div class="col-md-3 col-sm-4">
                    <div class="pull-right">
                        <a id="editable_comment_{!! $comment->id !!}_1" class="btn btn-info editable"
                           href="#edit_comment" data-pk="{!! $comment->id !!}"><i class="fa fa-pencil-square-o"></i>
                            Edit</a> <a id="deletable_comment_{!! $comment->id !!}_1" class="btn btn-danger deletable"
                                        href="{!! route('posts.comments.destroy', ['comments' => $comment->id]) !!}"><i
                                    class="fa fa-times"></i> Delete</a>
                    </div>
                </div>
            </div>
            <div class="visible-xs">
                <div class="col-xs-12">
                    <a id="editable_comment_{!! $comment->id !!}_2" class="btn btn-info editable" href="#edit_comment"
                       data-pk="{!! $comment->id !!}"><i class="fa fa-pencil-square-o"></i> Edit</a> <a
                            id="deletable_comment_{!! $comment->id !!}_2" class="btn btn-danger deletable"
                            href="{!! route('posts.comments.destroy', ['comments' => $comment->id]) !!}"><i
                                class="fa fa-times"></i> Delete</a>
                </div>
            </div>
        @else
            <div class="col-xs-12">
                <p><strong>{!! $comment->author !!}</strong>
                    - {!! html_ago($comment->created_at, 'timeago_comment_'.$comment->id) !!} @if(!$comment->approved && config('app.moderation'))
                        <i>Pending moderator approving</i> @endif</p>
                <p id="main_comment_{!! $comment->id !!}" class="main">{!! nl2br(e($comment->body)) !!}</p>
            </div>
        @endif
    </div>
@endif
@section('bottom')
    @include('partials.editComment')
@stop