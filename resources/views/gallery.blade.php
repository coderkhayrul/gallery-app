@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>{{ $album->name }}: ({{ count($album->images) }})</span>
                    <a href="{{ url('/') }}" class="btn btn-success btn-sm">Back</a>
                </div>

                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success'); }}
                    </div>
                    @endif
                    <div class="row">
                        @foreach ($album->images as $image)
                        <div class="col-sm-4">
                            <div class="item">
                                <a href="{{ url('album/').'/'.$image->id }}">
                                    <img src="{{ asset('storage/') }}/{{ $image->name }}" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            <br>

                            {{-- <form action="{{ route('album.destory',$image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $image->id }}" />
                            <br>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form> --}}

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fas fa-trash">Delete</i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    ...
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                </div>
                            </div>



                        </div>
                        @endforeach
                    </div>
                </div>
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
