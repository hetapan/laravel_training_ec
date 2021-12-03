@extends('template')
@section('content')
<section class="main">
    @php
        @dump(Auth::user()->toArray());
    @endphp
</section>
@endsection
