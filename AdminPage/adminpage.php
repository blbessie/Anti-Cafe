<!DOCTYPE html>
<style>
    .jumbotron {
        background-color: #fff;
        padding: 30px !important;
        border: 1px solid #dfe8f1;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    button, input, optgroup, select, textarea {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        width: 130px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="admin.js"></script>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <a href="../Login/logout.php" style="float:right;">Log out</a>
            <h1 id="hello,-world!">Admin Page<a class="anchorjs-link" href="#hello,-world!"><span class="anchorjs-icon"></span></a> </h1>
            <p>This page is used to review and update information about your users. </p>

                <div id="dialog-form" title="Create new user">

                    <form name="admin" action="" method="post">
                        <fieldset>

                            <label for="name">Username: </label>
                            <input type="text" id="username" name="username" class="text">&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="display" name="display" >DISPLAY</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="delete" name="delete" value="DELETE">DELETE</button>
                            &nbsp;&nbsp;
                            <label for="name">Amount: </label>
                            <input type="text" id="amount" name="amount" class="text">
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="add" name="add" value="ADD">ADD</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="remove" name="remove" value="REMOVE">REMOVE</button>

                        </fieldset>
                    </form>
                </div>

        </div>
        <table id="output" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>

            <tbody></tbody>
        </table>

    </div>
</body>
</html>
