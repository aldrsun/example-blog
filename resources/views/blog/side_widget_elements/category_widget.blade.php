<div class="card mb-4">
    <div class="card-header">{{__('categories')}}</div>
    <div class="card-body">
        <div class="row">
            @foreach($all_categories as $all_categories_item)

                <a href="{{url('category/?category_slugs%5B%5D='.$all_categories_item->slug)}}">
                    {{ $all_categories_item->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
