@php
$i = 1;
$slots = [];
while(isset(${'slot_' . $i})) {
    $slots[]['content'] = ${'slot_' . $i};
    $i++;
}
$items = array_merge($items, $slots)

@endphp
{{--{{dd($items)}}--}}
<div {!! $attributes->merge($attrs) !!} data-bs-ride="carousel" class="pl-10">
  @if($indicators == true && count($items) > 1)
    <ol class="carousel-indicators">
      @for($i = 0; $i < count($items); $i++)
        <li data-bs-target="#{{ $attrs['id'] }}" data-bs-slide-to="{{ $i }}"{!! $i == 0 ?  ' class="active"' : '' !!}></li>
      @endfor
    </ol>
  @endif

  <div class="carousel-inner ml-10" style="height: 400px">
    @foreach($items as $item)
      <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
          <img src="{{$item['media'][0]['original_url'] ?? asset('img/placeholder.jpg')}}" style="height: 400px">

{{--      @isset($item['media'][0])--}}

        @isset($item['name'])
          {!! $item['name'] !!}
        @endisset
      </div>
    @endforeach

  </div>

  @if($control == true && count($items) > 1)
    <a class="carousel-control-prev btn-dark" href="#{{ $attrs['id'] }}" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $attrs['id'] }}" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  @endif
</div>
