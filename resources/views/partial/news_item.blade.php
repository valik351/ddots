<div class="card-content">

    <a href="{{ url('news', ['id' => $news_item->id]) }}"><div class="card-title "><span>{{ $news_item->name }}</span></div></a>
    <p class="breaking-word">{{ str_limit($news_item->stripped_content, 150) }}</p>
    <p class="breaking-word right">{{ $news_item->created_at->diffForHumans() }}</p>

</div>