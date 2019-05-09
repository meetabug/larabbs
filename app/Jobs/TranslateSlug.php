<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    public function __construct(Topic $topic)
    {
        $this->topic =  $topic;
    }


    public function handle()
    {
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);

        \DB::table('topics')->where('id',$this->topic->id)->update(['slug' => $slug]);
    }
}
