<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carteirinha de Aluno</title>
  <style>
    body {
      margin: 20px;
      font-family: Arial, sans-serif;
    }
    table.carteirinha {
      width: 360px;                  /* Largura total */
      height: 230px;                 /* Altura total */
      border: 1px solid #333;
      border-radius: 8px;
      overflow: hidden;
      margin: 0 auto;
      border-collapse: collapse;     /* Remove espaçamentos internos */
      table-layout: fixed;           /* Respeita as larguras fixas das colunas */

      /* Imagem de fundo */
      background: url("{{ public_path('img/fundo.png') }}") no-repeat center center;
      background-size: cover;
      position: relative;
    }

    /* Cada célula (td) sem borda adicional, alinhada verticalmente ao meio */
    table.carteirinha td {
      vertical-align: middle;
      padding: 4px;
      margin: 0;
    }

    /* Coluna 1 = 90px */
    td.col-90 {
      width: 90px;
      
      text-align: left; /* Ajuste se quiser left/center/right */
    }

    /* Coluna 2 = 270px */
    td.col-270 {
      width: 270px;
      text-align: left;   /* Ajuste se quiser left/center/right */
      padding-left: 8px;  /* Espaço extra se necessário */
    }

    /* Logo */
    .logo-img {
      max-width: 60px;
      margin-top: 15px;
      height: auto;
      object-fit: contain;
    }

    /* Status em CAIXA ALTA, branco */
    .status-aluno {
      color: #fff;
      text-transform: uppercase;
      font-weight: bold;
      font-size: 1.3rem;  /* Ajuste conforme desejar */
    }

    /* Foto do Aluno */
    .foto-aluno {
      width: 120px;
      height: 120px;
      margin-top: 20px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 0 4px rgba(0,0,0,0.3);
    }

    /* Dados do aluno */
    .dados-aluno {
      color: #0A0F6F;  /* Azul escuro */
      font-size: 0.9rem;
    }
    .dados-aluno .nome-aluno {
    text-align: left;
      font-weight: bold;
      font-size: 1rem;
      margin: 4px 0;
    }

    /* QRCode (terceira linha, colspan=2) */
    td.qrcode-cell {
    text-align: left;  /* Ajuste se quiser outro alinhamento */
      
    }
    .qrcode-img {
      width: 60px;
      height: 60px;
      margin-left:30px;
    }

  </style>
</head>
<body>

<table class="carteirinha">

  <!-- Linha 1: Logo (90px) | Status (270px) -->
  <tr>
    <td class="col-90">
      @if($instituicao && $instituicao->dad_logo && file_exists(public_path($instituicao->dad_logo)))
        <img src="{{ public_path($instituicao->dad_logo) }}" alt="Logo" class="logo-img">
      @endif
    </td>
    <td class="col-270">
      <div class="status-aluno">
        {{ strtoupper($aluno->alu_status ?? 'ALUNO') }}
      </div>
    </td>
  </tr>

  <!-- Linha 2: Foto (90px) | Dados do Aluno (270px) -->
  <tr>
    <td class="col-90">
      @if($aluno->alu_foto && file_exists(public_path($aluno->alu_foto)))
        <img src="{{ public_path($aluno->alu_foto) }}" alt="Foto Aluno" class="foto-aluno">
      @else
        <img src="{{ public_path('img/sem_foto.png') }}" alt="Sem foto" class="foto-aluno">
      @endif
    </td>
    <td class="col-270">
      <div class="dados-aluno">
        <p><strong></strong> 
           {{ $aluno->alu_ra }}-{{ $aluno->alu_digito_ra }}/{{ $aluno->alu_uf_ra }}</p>
        <div class="nome-aluno">{{ $aluno->alu_nome }}</div>
        <p><strong></strong> {{ $aluno->alu_turma }}</p>
      </div>
    </td>
  </tr>

  <!-- Linha 3: QRCode (colspan=2) -->
  <tr>
    <td class="qrcode-cell" colspan="2">
      @if(!empty($qrCodeUrl))
        <img src="{{ $qrCodeUrl }}" alt="QRCode do Aluno" class="qrcode-img">
      @endif
    </td>
  </tr>

</table>

</body>
</html>
