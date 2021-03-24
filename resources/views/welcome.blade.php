<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PAYTOUR-TESTE') }}</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: rgb(245, 245, 245);
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 200px;
            background-color: rgb(34, 34, 34);
            color: white;
        }

        label.error {
            color: red;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .send-form {
            width: 600px;
        }

        .send-form form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .form-control {
            width: 97%;
            height: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 8px;
        }

        .form-control:focus {
            outline-color: rgba(61, 120, 209, 0.308);
        }

        .btn {
            background-color: rgba(61, 120, 209, 0.308);
            width: 100%;
            padding: 10px;
            border: 0.5px solid #ccc;
            border-radius: 10px;
        }

        select {
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 8px;
        }

        textarea {
            width: 97%;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 8px;
        }

        textarea:focus {
            outline-color: rgba(61, 120, 209, 0.308);
        }

        .alert {
            width: 97%;
            padding: 10px;
            margin: 10px 0px;
            border-radius: 20px;
            font-size: 13px;
        }
        .alert-danger {
            background-color: rgb(161, 0, 0);
            color: white;
        }
        .alert-success {
            background-color: green;
            color: white;
        }


    </style>
</head>

<body>
    <header>
        <h1>PAYTOUR</h1>
    </header>
    <main>
        <div class="title">
            <h3>Envie o seu currículo</h3>
        </div>
        <div class="send-form">
            @if (session('successMessage'))
            <div class="alert alert-success">
                <p>{{ session('successMessage') }}</p>
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('candidato.novo') }}" id="form-candidato" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="nome">Nome <span style="color: red">*</span> </label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="form-group">
                    <label for="email">Email <span style="color: red">*</span> </label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone <span style="color: red">*</span> </label>
                    <input type="tel" class="form-control" name="telefone" id="telefone">
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo Desejado <span style="color: red">*</span> </label>
                    <input type="text" class="form-control" name="cargo" id="cargo">
                </div>
                <div class="form-group">
                    <label for="escolaridade">Escolaridade <span style="color: red">*</span> </label>
                    <select name="escolaridade" id="escolaridade">
                        @foreach ($escolaridades as $escolaridade)
                            <option value="{{ $escolaridade->id }}">{{ $escolaridade->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="observacao">Observações</label>
                    <textarea name="observacao" id="observacao"></textarea>
                </div>
                <div class="form-group">
                    <label for="arquivo">Arquivo <span style="color: red">*</span>  (Extensões suportadas: .doc, .docx ou .pdf)</label>
                    <input type="file" name="arquivo" id="arquivo" accept=".doc,.docx,.pdf">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">ENVIAR</button>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script>
        var create = $('#form-candidato').validate({
            rules: {
                nome: "required",
                email: {
                    required: true,
                    email: true,
                },
                telefone: "required",
                cargo: "required",
                escolaridade: "required",
                arquivo: "required",
            },
            messages: {
                nome: "Este campo é obrigatório",
                email: {
                    required: "Este campo é obrigatório",
                    email: "Insira um email válido",
                },
                telefone: "Este campo é obrigatório",
                cargo: "Este campo é obrigatório",
                escolaridade: "Este campo é obrigatório",
                arquivo: "Este campo é obrigatório",
            }
        });
    </script>
</body>

</html>
