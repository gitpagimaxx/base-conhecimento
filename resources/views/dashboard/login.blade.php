<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#7952b3">
    <script src="https://kit.fontawesome.com/60279106a5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="icon" type="image/png" href="/images/icone.png" />
    <title>Dashboard</title>
</head>
<body>
    <div class="container"> 

        <div class="columns is-centered">
            <div class="column is-one-third">
                <form action="">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="email" name="email" placeholder="Email">
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="password" name="password" placeholder="Password">
                            <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <button class="button is-primary">Entrar</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>