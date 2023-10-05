@extends('adminlte::page')

@section('title', 'Add New Review')

@section('content_header')
<h1>
    Add New Review
</h1>
@stop
@section('content')
<section class="content">
    <a href="{{route('reviews')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Reviews</a>

    <!-- general form elements -->
    <div class="box box-primary">

        <!----------------------- Message ------------------------------->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $errors->first() }}
        </div>
        @endif

        <form class="form-horizontal" method="post" name="form1" id="form1" action="/saveReview" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control required" placeholder="Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description" class="control-label">Description</label>
                            <input type="text" id="description" name="description" value="{{old('description')}}" class="form-control required" placeholder="Description" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="review_date" class="control-label">Review Date</label>
                            <input type="date" id="review_date" mix="{{date('Y-m-d')}}" name="review_date" value="{{old('review_date')}}" class="form-control required" placeholder="review_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="image" class="control-label">Review Image</label>
                            <select name="image" class="form-control required" required>
                                <option value="star-rating-google.png" selected>star-rating-google.png</option>
                                <option value="star-rating-yelp.png">star-rating-yelp.png</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" id="submit" name="submit" value="" class="btn btn-primary">Submit
                    <i class="fa fa-refresh fa-spin" style="display:none;" id="page_load_div"></i>
                </button>
            </div>
    </div>
    </form>
    </div><!-- /.box -->
</section>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $("#form1").submit(function() {
            var is_error = false;
            $("#form1 .required").each(function(index) {
                if ($(this).val() == '') {
                    var field_name = $(this).attr("id");
                    alert("Please enter " + field_name);
                    $(this).focus();
                    is_error = true;
                    return false;
                }
            });
            if (is_error) {
                return false;
            }
            $("#submit").attr("disabled", true);
            $('#page_load_div').show();
            return true;
        });
    });
</script>
@stop