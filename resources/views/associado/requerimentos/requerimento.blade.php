<html>

<head>
    <style>
        * {
            background: transparent !important;
            color: #000 !important;
            text-shadow: none !important;
            filter: none !important;
            -ms-filter: none !important;
        }

        body {
            margin: 0;
            padding: 0;
            line-height: 1.4em;
            font: 12pt Georgia, "Times New Roman", Times, serif;
            color: #000;
        }

        @page {
            margin: 1.5cm;
        }

        .wrap {
            width: 100%;
            margin: 0;
            float: none !important;
        }

        .no-print,
        nav,
        footer,
        video,
        audio,
        object,
        embed {
            display: none;
        }

        .print {
            display: block;
        }

        img {
            max-width: 100%;
        }

        aside {
            display: block;
            page-break-before: always;
        }



        p {
            font-size: 12pt;
            font-size: 0.8em;
            widows: 3;
            orphans: 3;
        }

        @media print {

            * {
                background: transparent !important;
                color: #000 !important;
                text-shadow: none !important;
                filter: none !important;
                -ms-filter: none !important;
            }

            body {
                margin: 0;
                padding: 0;
                line-height: 1.4em;
                font: 12pt Georgia, "Times New Roman", Times, serif;
                color: #000;
            }

            @page {
                margin: 1.5cm;
            }

            .wrap {
                width: 100%;
                margin: 0;
                float: none !important;
            }

            .no-print,
            nav,
            footer,
            video,
            audio,
            object,
            embed {
                display: none;
            }

            .print {
                display: block;
            }

            img {
                max-width: 100%;
            }

            aside {
                display: block;
                page-break-before: always;
            }

            h1 {
                font-size: 24pt;
            }

            h2 {
                font-size: 18pt;
            }

            h3 {
                font-size: 14pt;
            }

            p {
                font-size: 12pt;
                font-size: 0.8em;
                widows: 3;
                orphans: 3;
            }

            a,
            a:visited {
                text-decoration: underline;
            }

            a:link:after,
            a:visited:after {
                content: " (" attr(href) ") ";
            }

            p a {
                word-wrap: break-word;
            }

            q:after {
                content: " (" attr(cite) ")"
            }

            a:after,
            a[href^="javascript:"]:after,
            a[href^="#"]:after {
                content: "";
            }

            .page-break {
                page-break-before: always;
            }

            /*Estilos da Demo*/
            .header.print h1 {
                width: 100%;
                margin-bottom: 0.5cm;
                font-size: 18pt;
            }

            .header.print:after {
                content: "Este artigo foi escrito pela designer Dani Guerrato e retirado do site Tableless.";
            }

            .artigo {
                margin-top: 0;
                border-top: 1px solid #000;
                padding-top: 1cm;
            }

            h1 a:link:after,
            h1 a:visited:after {
                content: "";
            }
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
            background-color: transparent;
            font-size: 1em;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #eceeef;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #eceeef;
        }

        .table td,
        .table th {
            padding: 8px;
            vertical-align: top;
            border-top: 1px solid #eceeef;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #eceeef;
        }

        .table td,
        .table th {
            padding: 8px;
            vertical-align: top;
            border-top: 1px solid #eceeef;
        }

        .table-bordered {
            border: 1px solid #eceeef;
        }

        body {
            font-size: 0.8em;
        }

        #ficha {
            width: 210mm;
            border: 1px solid gray;
            height: 297mm;
            margin: 0 auto;
            padding: 10mm 10mm 20mm 10mm;

        }

        #ficha div {
            float: left
        }

        .ficha_logo {
            width: 10%
        }

        .ficha_centro {
            width: 80%;
            text-align: center
        }

        .ficha_cabecalho {
            width: 100%
        }

        .requerimento {
            margin-top: 0px;
            text-align: center;
        }

        .row {
            width: 100%;
            float: left
        }

        p {
            float: left;
            margin: 7px 10px 7px 0;
        }

        .underline {
            border-bottom: 1px solid #808080;
            width: 100%;
            font-weight: 600;

        }

        .w75 {
            width: 75px
        }

        .w100 {
            width: 100px
        }

        .w125 {
            width: 125px
        }

        .w150 {
            width: 150px
        }

        .w175 {
            width: 175px
        }

        .w200 {
            width: 200px
        }

        .w250 {
            width: 250px
        }

        .w275 {
            width: 275px
        }

        .w300 {
            width: 300px
        }

        .w325 {
            width: 325px
        }

        .w350 {
            width: 350px
        }

        .w400 {
            width: 400px
        }

        .w450 {
            width: 450px
        }

        .w500 {
            width: 500px
        }

        .w550 {
            width: 550px
        }

        .w575 {
            width: 575px
        }

        .w600 {
            width: 600px
        }

        .w625 {
            width: 625px
        }

        .w650 {
            width: 650px
        }

        .ficha_nome {
            width: 580px
        }

        .ficha_cpf {
            width: 120px
        }
    </style>

</head>

<body>
    <div id="ficha">
        <div class="ficha_cabecalho">
            <div class="ficha_logo"><img src="https://admin.asprarn.com.br/images/logo.JPG" alt=""></div>
            <div class="ficha_centro">
                <h2 style="margin-top: 0">ASSOCIAÇÃO DOS PRAÇAS DA POLÍCIA MILITAR<br>
                    DO ESTADO DO RIO GRANDE DO NORTE<br>
                    FUNDADA EM 21 DE ABRIL DE 2003<br>
                    (ASPRA PM/RN)</h2><br>
            </div>
            <div class="ficha_logo"></div>

        </div>
        <div class="row">
            <h2 class="requerimento">REQUERIMENTO</h2>
        </div>

        <div class="row">
            <p>Senhor Presidente,</p>
        </div>
        <div class="row">
            <p>Eu,</p>
            <p class="w550 underline">ALEX JOSE OLIVEIRA</p>
            <p>CPF: </p>
            <p class="w125 underline">&nbsp;96846763449</p>
        </div>
        <div class="row">
            <p>RG: </p>
            <p class="w75 underline">&nbsp;</p>
            <p>Estado Civil:</p>
            <p class="w125 underline">&nbsp;</p>
            <p>Graduação:</p>
            <p class="w75 underline">&nbsp;</p>
            <p>Nº Praça:</p>
            <p class="w75 underline">&nbsp;</p>
            <p>Matrícula:</p>
            <p class="w75 underline">&nbsp;1081195</p>
        </div>
        <div class="row">
            <p>OPM:</p>
            <p class="w300 underline">&nbsp;</p>
            <p>Horário de trabalho:</p>
            <p class="w100 underline">&nbsp;</p>
            <p>NASCIDO EM:</p>
            <p class="w100 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Filho(a) de:</p>
            <p class="w325 underline">&nbsp;</p>
            <p>e</p>
            <p class="w325 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Endereço:</p>
            <p class="w500 underline">&nbsp;</p>
            <p>Número:</p>
            <p class="w100 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Bairro:</p>
            <p class="w350 underline">&nbsp;</p>
            <p>Cidade:</p>
            <p class="w300 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Complemento:</p>
            <p class="w600 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Cursos Civis:</p>
            <p class="w600 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Grau de Instrução:</p>
            <p class="w600 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Telefone Celular:</p>
            <p class="w125 underline">&nbsp;</p>
            <p>Telefone Residencial:</p>
            <p class="w125 underline">&nbsp;</p>
            <p>Telefone Trabalho:</p>
            <p class="w125 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>E-mail:</p>
            <p class="w300 underline">&nbsp;</p>
        </div>

        <div class="row">
            <p>Em caso de acidente avisar à:</p>
            <p class="w275 underline">&nbsp;</p>
            <p>Endereço:</p>
            <p class="w250 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Nº:</p>
            <p class="w100 underline">&nbsp;</p>
            <p>Bairro:</p>
            <p class="w275 underline">&nbsp;</p>
            <p>Cidade:</p>
            <p class="w250 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>Telefone Celular:</p>
            <p class="w125 underline">&nbsp;</p>
            <p>Telefone Residencial:</p>
            <p class="w125 underline">&nbsp;</p>
            <p>Telefone Trabalho:</p>
            <p class="w125 underline">&nbsp;</p>
        </div>
        <div class="row">
            <p>venho, mui respeitosamente, REQUER a Vossa Excelência, a minha inscrição no quadro social desta entidade,
                como sócio ____________________, de acordo com a letra ________, do art. ________ e Inciso _________ §§
                ____ e ____, do art. ________, do Estatuto Social desta entidade, autorizando desde já o desconto da
                mensalidade ou despesas em folha de pagamento ou na</p>
        </div>



        <div class="row">
            <p>Conta Nº: </p>
            <p class="w100 underline">&nbsp;</p>
            <p>Agência: </p>
            <p class="w100 underline">&nbsp;</p>
            <p>Banco: </p>
            <p class="w300 underline">&nbsp;</p>
        </div>



        <div class="row">
            <p>Código para Débito Nº: </p>
            <p class="w200 underline">&nbsp;</p>
            <p>Contrato de Convênio Nº: </p>
            <p class="w200 underline">&nbsp;</p>
        </div>

        <div class="row">
            <p>Estou ciente que as informações aqui prestadas são de minha inteira responsabilidade, e que, caso queira
                pedir desligamento do quadro social, e tiver em débito para com esta entidade terei que ressarcir a
                mesma de acordo com as diretrizes traçadas pela Diretoria Financeira da mesma, sem direito a qualquer
                ressarcimento dos valores já pagos, autorizando, desde já a ASPRA PM/RN, a me representar ativa ou
                passivamente, em juízo ou fora dele, de acordo com o inciso XXI, do Art. 5º da CF, e legislação
                pertinente, em todas as ações, coletivas ou individual, em que tomar parte, que seja de meu interesse ou
                da categoria.</p>
        </div>

        <div class="row" style="margin-top:30px;">
            <p class="w300 underline" style="">&nbsp;</p>
            <p>,</p>
            <p class="w75 underline">&nbsp;</p>
            <p class="w100 underline">/</p>
            <p class="w75 underline">/</p>
        </div>
        <div class="row">
            <p style="margin-top: 0">Local e data</p>
        </div>
        <div class="row" style="margin-top:30px;">
            <p class="w600 underline" style="">&nbsp;</p>
        </div>
        <div class="row">
            <p style="margin-top: 0">Requerente</p>
        </div>
    </div>


</body>

</html>
