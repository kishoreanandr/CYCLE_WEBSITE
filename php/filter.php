<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Filtering Page</title>

</head>
<body>
    <div class="container" style="max-width:50%">

    <div class="text-center mt-5 mb-4">
        <h2>PHP MYSQL Live Search</h2>
    </div>

        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search...">
    </div>

    <div id="searchresult">

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
        $(document).ready(function()
        {
            $("#live_search").keyup(function()
            {
                var input=$(this).val(); //This will store the value what we type 
                // alert(input);

                if(input!="") //this will redirect to url if input is not empty
                {
                    $.ajax({
                        url:"livesearch.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data) //after success it will show the result in that div 
                        {
                            $("#searchresult").html(data);
                            $("#searchresult").css("display","block");
                        }
                    });
                }
                else //if the input is none the div will hide
                {
                    $("#searchresult").css("display","none");
                }
            });
        });
    </script>

</body>
</html>