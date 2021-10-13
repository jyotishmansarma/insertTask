<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hello, world!</title>
</head>

<body>
    <div class="container col-6 float-auto" style="padding-top:40px ">
        <div class="row">
            <h4 class="btn btn-secondary"><strong>Insert Record</strong></h4>
        </div>

    </div>
    <div class="container col-6 float-auto">
        <div class="row">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            @endif
        </div>
    </div>
    <form action="{{ route('store.data') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container col-6 float-auto card text-white bg-secondary">
            <div class="row" style="padding-top:10px">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-5">
                        <input type="date" name="date" class="form-control" id="inputPassword">
                    </div>

                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Time</label>
                    <div class="col-sm-5">
                        <input type="time" name="time" class="form-control" id="inputPassword">
                    </div>

                </div>
                <div class="land-owner-parent ">
                    <div id="land_owner">
                        <div class="row">
                            <div class="col-md-10 mb-2">
                                <div class="form-group ">

                                    <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image[]" id="inputPassword">
                                    </div>

                                </div>
                            </div>
                            <div class="text-left col-md-offset-5 remove_applicant">
                                <button type="button" class="btn btn-danger" onclick="removeLandOwner(this)">Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-b-8" style="padding-top:10px;">
                    <div class="text-left  col-md-offset-5">
                        <button type="button" class="btn btn-primary" onclick="addMoreLandOwner()">
                            Add more Image
                        </button>
                    </div>
                </div>

            </div>
            <div class="container col-3 float-auto">
                <div class="row">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>

            </div>
        </div>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        var remove_landowner_button = '<button type="button" class="btn btn-danger" onclick="removeLandOwner(this)">' +
            '<i class="material-icons"> delete_sweep </i>' +
            '</button>';
        addMoreLandOwner = function() {
            var count = 0;
            ++count;
            if ($(".land-owner-parent").length) {
                var clone_data = $(".land-owner-parent:last").clone();
                $(clone_data).find("input, select, textarea").val("");

                $(clone_data).find(".remove_button").html(remove_landowner_button);
                $(clone_data).hide();
                var clone_data = $(".land-owner-parent:last").after(clone_data);
                $(".land-owner-parent:last").show("slow");
                $('select').selectpicker();
            } else {
                alert("Add maximum three file");

            }

        }
        removeLandOwner = function(obj) {
            console.log("remove button click");
            if ($(".land-owner-parent").length == 1) {
                alert("Atleast one File required.");
                return false;
            }
            $(obj).parents(".land-owner-parent").hide("slow", function() {
                $(this).remove();
            });
        }
    </script>


</body>

</html>
