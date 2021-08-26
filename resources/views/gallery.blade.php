@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>{{ $album->name }}: ({{ count($album->images) }})</span>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                        data-target="#exampleModal">
                        Add Image
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form" action="{{ route('album.addmore') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{$album->id}}">
                                        </div>
                                        <div class="input-group control-group intial-add-more">
                                            <input type="file" name="image[]" class="form-control" id="image">
                                            <div class="input-group-btn">
                                                <button class="btn btn-success btn-add-more" type="button"><i
                                                        class="fas fa-plus"></i>Add</button>
                                            </div>
                                        </div>
                                        <div class="copy" style="display:none">
                                            <div class="input-group control-group add-more" style="margin-top:12px;">
                                                <input type="file" name="image[]" class="form-control" id="image">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-danger remove" type="button"><i
                                                            class="fas fa-minus-circle"></i>Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{ $image->id  }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $image->id  }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do You Went To Delete {{ $image->id  }} ?
                                        </div>
                                        <div class="modal-footer d-flex justify-content-right">
                                            <form action="{{ route('album.destory',$image->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $image->id }}" />
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </form>
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


@section('custrom_script')

<script type="text/javascript">
    $(document).ready(function (e) {
        $('.btn-add-more').click(function () {
            var html = $('.copy').html();
            $('.intial-add-more').after(html);
        });

        $('body').on('click', '.remove', function () {
            $(this).parents('.control-group').remove();
        });
    });

</script>
@endsection
