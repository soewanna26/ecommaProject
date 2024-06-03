<div style="text-align: center" class="mb-2">
    <h1 style="font-size: 30px;text-align: center;padding-top: 20px;padding-bottom: 20px">Comments</h1>
    <form action="{{ route('add_comment') }}" method="POST">
        @csrf
        <textarea name="comment" id="comment" style="width: 600px;height: 150px;" placeholder="Comment something here"></textarea>
        <br>
        <button type="submit" class="btn btn-primary">Comment</button>
    </form>
</div>
<div style="padding-left: 20%;margin-bottom: 5px">
    <h1 style="font-size: 20px;padding-bottom: 20px">All Comments</h1>
    @if ($comments->isNotEmpty())
        @foreach ($comments as $comment)
            <div class="mt-2 comment-block">
                <b>{{ $comment->name }}</b>
                <p>{{ $comment->comment }}</p>
                @if (Auth::check() && Auth::user()->name !== $comment->name)
                    <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{ $comment->id }}">Reply</a>
                @elseif (!Auth::check())
                    <a href="javascript:void(0);" onclick="reply(this)" data-Commentid="{{ $comment->id }}">Reply</a>
                @endif
                @foreach ($replies as $reply)
                    @if ($reply->comment_id == $comment->id)
                        <div style="padding-left: 5%;padding-bottom: 10px">
                            <b>{{ $reply->name }}</b>
                            <p>{{ $reply->reply }}</p>
                            @if (Auth::check() && Auth::user()->name !== $reply->name)
                                <a href="javascript:void(0);" onclick="reply(this)"
                                    data-Commentid="{{ $comment->id }}">Reply</a>
                            @elseif (!Auth::check())
                                <a href="javascript:void(0);" onclick="reply(this)"
                                    data-Commentid="{{ $comment->id }}">Reply</a>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
    <div style="display: none" class="replyDiv">
        <form action="{{ route('add_reply') }}" method="POST">
            @csrf
            <input type="text" id="commentId" name="commentId" hidden>
            <textarea name="reply" style="height: 100px;width: 500px" placeholder="Write Something Here"></textarea>
            <br>
            <button type="submit" class="btn btn-outline-primary">Reply</button>
            <a href="javascript:void(0);" class="btn btn-outline-danger" onclick="reply_close(this)">Close</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>

<script type="text/javascript">
    function reply(caller) {
        // Hide all Reply links
        $('a[data-Commentid]').show();
        // Show the clicked Reply link
        $(caller).hide();
        document.getElementById('commentId').value = $(caller).attr('data-Commentid');
        $('.replyDiv').insertAfter($(caller).parent()); // Insert the reply form after the comment or reply
        $('.replyDiv').show();
    }

    function reply_close(caller) {
        $('.replyDiv').hide();
        // Show all Reply links when the form is closed
        $('a[data-Commentid]').show();
    }
</script>
