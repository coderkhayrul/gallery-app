@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header bg-primary text-white">Image Add</div>

                <div class="card-body">
                    <div class="show">
                    </div>
                    <div class="error_message">
                    </div>
                    <form id="form" action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="album">Name Of Album</label>
                            <input type="text" name="album" class="form-control">
                        </div>

                        <div class="input-group control-group intial-add-more">
                            <input type="file" name="image[]" class="form-control" id="image">
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-add-more" type="button"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="copy" style="display:none">
                            <div class="input-group control-group add-more" style="margin-top:12px;">
                                <input type="file" name="image[]" class="form-control" id="image">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger remove" type="button"><i
                                            class="fas fa-minus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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

<script type="text/javascript">
    $(document).ready(function (e) {
        $("#form").on('submit', function (e) {
            e.preventDefault();

            // Validation
            // var album = $('#album').val();
            // if (album == '' ) {
            //     alert("Error");
            //     return false;
            // }

            $.ajax({
                url: "/album",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $('.show').html(response);
                    $('#form')[0].reset();
                    $(".error_message").empty();
                },
                error: function (data) {
                    // console.log(data.responseJSON);
                    $(".error_message").empty();
                    var error = data.responseJSON;
                    $.each(error.errors , function (key, value) {
                        $('.error_message').append('<p class="text-center text-danger">'+value+'</p>');
                    });
                },
            });
        });

    });

</script>
@endsection
