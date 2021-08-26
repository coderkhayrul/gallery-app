@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                @foreach ($albums as $album)
                <div class="col-sm-4">
                    <div class="item">
                        <a href="{{ url('album/').'/'.$album->id }}">
                            <img src="{{ asset('storage/uploads/sidebar-banner-2.jpg') }}" class="img-thumbnail" alt="">
                            <a href="{{ url('album/').'/'.$album->id }}" class="centered">{{ $album->name }}</a>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- <div class="card">
                <div class="card-header bg-primary text-white">All Image</div>

                <div class="card-body">

                </div>
            </div> --}}
        </div>
    </div>
</div>
<style>
.item{
    left: 0;
    top: 0;
    position: relative;
    overflow: hidden;
    margin-top:50px;
}
.item img{
    -webkit-transition: 0.6s ease;
    transition: 0.6s ease;
}
.item a{
   text-decoration: none;
}
.item img:hover{
    -webkit-transform:scale(1.2);
    transform:scale(1.2);
}
.centered{
    position:absolute;
    top: 50%;
    left: 50%;
    transform: trnaslate(-50%, -50%);
    color: #fff;
    font-size: 24px;
    font-family: bold;
}
.img-thumbnail{
    border: 0;
    border-radius: 0px;
}
</style>
@endsection
