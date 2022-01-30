@foreach ($comments as $comment)
<div class="media mt-30">
    <div class="media-body">
        <div class="clearfix">
            <div class="name-commenter pull-left">
                <h6 class="media-heading"><a
                    href="javascript:">{{ $comment->users->name ?? '' }}</a>
                <span
                    class="ml-10"><?= Helper::instance()->show_stars($comment->rate) ?></span>
            </h6>
                <p class="mb-10"> {{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}</p>
            </div>
        </div>
        <p class="mb-0">{{ $comment->content }}</p>
    </div>
</div>
@endforeach