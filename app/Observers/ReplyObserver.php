<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        // xss 过滤
        $reply->content = clean($reply->content, 'user_topic_body');

        // 判断内容为空的处理方式，拒绝保存入库
        if ($reply->content === '') {
            return false;
        }
    }

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();
        // 通知话题作者有新的评论
        $reply->topic->user->notify(new TopicReplied($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }

    public function updating(Reply $reply)
    {
        //
    }
}
