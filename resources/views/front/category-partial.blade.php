@foreach ($links as $link)
    <p class="my-4 fw-bold">{{$link->col_name('title')}}</p>
    @foreach ($link->children as $child)
        <p class="my-1"><a class="small text-secondary" href="#">{{$child->col_name('title')}}</a></p>
    @endforeach
@endforeach