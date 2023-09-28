@extends('adminlte::page')

@section('title', 'Add New Team Member')

@section('content_header')
<h1>
    Add New Team Member
</h1>
@stop
@section('content')
<section class="content">
    <a href="{{route('meettheteam')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Meet The Team</a>

    <!-- general form elements -->
    <div class="box box-primary">

        <!----------------------- Message ------------------------------->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $errors->first() }}
        </div>
        @endif

        <form class="form-horizontal" method="post" name="form1" id="form1" action="/saveTeamMember" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control required" placeholder="Team Member Full Name" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control required" placeholder="Title" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="sequence" class="control-label">Sequence</label>
                        <input type="number" id="sequence" min="0" name="sequence" value="{{old('sequence')}}" class="form-control required" placeholder="Sequence" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="leave_me_review_link" class="control-label">Leave Me a Review Link</label>
                        <input type="text" id="leave_me_review_link" name="leave_me_review_link" value="{{old('leave_me_review_link')}}" class="form-control required" placeholder="Leave Me a Review Link" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="review_link" class="control-label">My Reviews Link</label>
                        <input type="text" id="review_link" name="review_link" value="{{old('review_link')}}" class="form-control required" placeholder="My Reviews Link" required>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="profile_img_link" class="control-label">Headshot Image Link</label>
                        <input type="text" id="profile_img_link" name="profile_img_link" value="{{old('profile_img_link')}}" class="form-control" placeholder="Headshot Image Link">
                        <img id="profile_img" src="#" style="display:none;" class="col-md-4 preview-img" />
                    </div>
                    <a class="btn btn-default" onclick="previewImgLink('profile_img')">preview</a>
                    <div class="form-group">
                        <label for="review_link" class="control-label">or</label>
                    </div>
                    <div class="form-group">
                        <img id="profile_image" src="#" style="display:none;" class="col-md-4 preview-img" />
                        <div class="col-md-6 form-group">
                            <label for="image">Upload Headshot Image</label>
                            <input type="file" onchange="previewImage(event, 'profile_image')" class="form-control" id="profile_img" name="profile_img">
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
    $("#delete_image").click(function() {
        if (confirm("Are you sure! You want to delete the picture?")) {
            var new_url = window.location + '&delete_image=1';
            $(location).attr('href', new_url);
            return false;
        } else {
            return false;
        }
    });

    function previewImgLink(previewId) {
        var input = document.getElementById('profile_img_link');
        if (input.value) {
            var imagePreview = document.getElementById(previewId);
            imagePreview.src = input.value;
            imagePreview.style.display = 'block';
        }
    }

    function previewImage(event, previewId) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById(previewId);
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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
            var profile_img = $("#profile_img").val();
            var profile_img_link = $("#profile_img_link").val();
            if (!profile_img && !profile_img_link) {
                alert('Please upload the headshot image or enter the headshot image link!');
                $('#profile_img_link').focus();
                return false;
            } else {
                $("#submit").attr("disabled", true);
                $('#page_load_div').show();
                return true;
            }
        });
    });
</script>
@stop