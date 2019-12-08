<html>
    <head>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <title>Crud Panel</title>
    </head>

    <body>
        <h1>Welcome to Crud Panel</h1>
        <form action="" method="post">
                @csrf
                <input type="text" name="model_name">
                <input type="submit" name="btn_submit_model" value="Submit">
        </form>
    </body>

    <script>
        $(document).ready(function() {

            $("input[name=btn_submit_model]").click(function(event){
                event.preventDefault();

                var model_name = $('input[name=model_name]').val();
                var _token = $('input[name=_token]').val();

                jQuery.ajax({
                    url: "model/create",
                    method: 'post',
                    data: { _token: _token, model_name: model_name },
                    success: function(response)
                    {
                        alert(response.message);
                    },
                    error: function (response)
                    {
                        alert(response.message);
                    }
                });

            });

        });

    </script>

</html>