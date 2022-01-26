<!DOCTYPE html>
<html lang="en">
<head>
   <?php require 'htmlhead.php'; ?>
</head>
<body>
    
    <?php require 'header.php'; ?>
   
    <main>
        <div class="container text-center">
                <h3 class="py-3">User not found. Please try again with a valid Ugsername</h3>

                <form method="get" action="searchuser.php">
                <div class="row">
                    <div class="col-md-10">
                        <input class="form-control" name="searchuser" placeholder="Please Enter a Valid Torre Username" >
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Display</button>
                    </div>
                </div>
                </form>

        </div>
    </main>


    <script>
    </script>
</body>
</html>