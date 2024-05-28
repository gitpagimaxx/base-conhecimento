<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/60279106a5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="icon" type="image/png" href="/images/icone.png" />
    <title>Dashboard do Blog</title>
</head>
<body>
<div class="container">

    <section class="section">
    

        <div class="columns is-centered">
            <div class="column is-one-third">

                <h1 class="title">Registrar-se</h1>

                <form action="">
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Seu nome">
                    </div>
                </div>

                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control">
                        <input class="input" type="email" placeholder="Seu e-mail">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Senha</label>
                    <div class="control">
                        <input class="input" type="password" placeholder="Bem forte hein">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Confirme a senha</label>
                    <div class="control">
                        <input class="input" type="password" placeholder="Tem que ser igual a de cima">
                    </div>
                </div>

                <div class="field">
                    <p class="mt-3">
                        <button class="button is-primary" name="submit">Registrar</button>
                    </p>
                </div>
                </form>

            </div>

        </div>
    
    </section>
    
        
</div>


</body>
</html>