<html>
    <head>
        <title>Crud Panel</title>
    </head>

    <body>
        <h1>Welcome to Crud Panel</h1>
        <form action="model/create" method="post">
                @csrf
                <input type="text" name="model_name">
                <input type="submit" value="Submit">
        </form>
    </body>

</html>