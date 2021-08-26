@if (Auth::check())
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
@endif
