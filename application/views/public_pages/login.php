<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo (CSS);?>bootstrap.css" />
        <link href="<?php echo (CSS);?>style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php echo 
            form_open('page/login_authentication', 'login_form','');
            ?>

                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" value="" id="email>
                <label for="password">Password</label>
                <input class="form-control" type="text" name="password" value="" id="password">
                <button type="submit">Login</button>

            </form>                
        
        </div>

    <script src="<?php echo (JS);?>app.min.js" />
   <script>
       ajaxSend('login_form','page/login_authentication');
   </script>
    </body>
</html>

