<!DOCTYPE html>
<html>
<head>
    <title>PAYTOUR - FANSONI MUZANZO</title>
</head>
<body>
    <h1>{{ $details['nome'] }}</h1>
    <p>Email: {{ $details['email'] }}</p>
    <p>Telefone: {{ $details['telefone'] }}</p>
    <p>Cargo: {{ $details['cargo'] }}</p>
    <p>Escolaridade: {{ $details['escolaridade'] }}</p>
    <p>Observações: {{ $details['observacao'] }}</p>
    <p>Data de envio: {{ date_format($details['data_envio'],"Y/m/d H:i:s") }}</p>
    <a href="{{ asset('uploads/candidatos/'.$details['arquivo']) }}">Clique aqui para ver o currículo</a>

    <p>Enviado por Fansoni System Developer</p>
</body>
</html>
