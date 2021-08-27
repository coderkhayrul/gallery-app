@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (Auth::check())
            @if (Auth::user()->user_type == 'admin')
            <a href="{{ route('album.index') }}" class="btn btn-primary">Create Album</a>
            @endif
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success'); }}
            </div>
            @endif
            <div class="row">
                @foreach ($albums as $album)
                <div class="col-sm-4">
                    <div class="item">
                        <a href="{{ url('album/').'/'.$album->id }}">
                            <img style="width:285px; height: 185px;"
                                src="{{ !empty($album->image) ? asset('storage/'.$album->image) : asset('storage/uploads/sidebar-banner-2.jpg') }}"
                                class="img-thumbnail" alt="">
                            <a href="{{ url('album/').'/'.$album->id }}" class="centered">{{ $album->name }}</a>
                        </a>
                    </div>

                    @if (Auth::check())
                    @if (Auth::user()->user_type == 'admin')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                        data-target="#exampleModal{{ $album->id }}">
                        Add Album Image
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $album->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Album Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="{{ route('add.album.image') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="file" name="image" class="form-control">
                                        <input type="hidden" name="id" value="{{ $album->id }}" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<style>
    .item {
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .item img {
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
    }

    .item a {
        text-decoration: none;
    }

    .item img:hover {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: trnaslate(-50%, -50%);
        color: #fff;
        font-size: 24px;
        font-family: bold;
    }

    .img-thumbnail {
        border: 0;
        border-radius: 0px;
    }

</style>
@endsection
