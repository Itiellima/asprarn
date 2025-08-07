@extends('layouts.main')

@section('title', 'Novo associado')

@section('content')


    <h1>Insira os dados do novo associado</h1>

    <div class="container mb-3">
        <div class="container">
            <form action="/associado/store" method="POST">
                @csrf
                {{-- DADOS PESSOAIS --}}
                <div class="container row border-top border-bottom border-primary">
                    <h2>Dados pessoais</h2>
                    <div class="mb-3 col-6">
                        <label for="formGroup" class="form-label">Nome:</label>
                        <input type="text" class="form-control " id="nome" name="nome"
                            placeholder="Insira o nome do associado" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">CPF:</label>
                        <input type="text" class="form-control " id="cpf" name="cpf"
                            placeholder="Insira o CPF do associado" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">RG:</label>
                        <input type="text" class="form-control " id="rg" name="rg"
                            placeholder="Insira o numero do RG" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Órgão expedidor:</label>
                        <input type="text" class="form-control " id="org_expedidor" name="org_expedidor"
                            placeholder="Órgão expedidor" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Nome do pai:</label>
                        <input type="text" class="form-control " id="nome_pai" name="nome_pai"
                            placeholder="Insira o nome do pai">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Nome da Mãe:</label>
                        <input type="text" class="form-control " id="nome_mae" name="nome_mae"
                            placeholder="Insira o nome da mãe">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control " id="dt_nasc" name="dt_nasc" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Estado civil:</label>
                        <select class="form-select " name="estado_civil" id="estado_civil" required>
                            <option selected disabled>Selecione</option>
                            <option value="solteiro">Solteiro</option>
                            <option value="Casado">Casado</option>
                            <option value="uniao_estavel">Uniao Estavel</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="viuvo">Viuvo</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Grau de Instrução:</label>
                        <select class="form-select " name="grau_instrucao" id="grau_instrucao">
                            <option selected disabled>Selecione</option>
                            <option value="fundamental_completo">Ensino fundamental completo</option>
                        </select>
                    </div>
                </div>

                {{-- Endereço --}}
                <div class="container row border-bottom border-primary mt-3">
                    <h2>Endereço</h2>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">CEP:</label>
                        <input type="number" class="form-control " id="cep" name="cep"
                            placeholder="59000-000 apenas numeros" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="formGroup" class="form-label">Logradouro:</label>
                        <input type="text" class="form-control " id="logradouro" name="logradouro"
                            placeholder="Rua..." required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Numero:</label>
                        <input type="text" class="form-control " id="nmr" name="nmr"
                            placeholder="Número da residência" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="formGroup" class="form-label">Bairro:</label>
                        <input type="text" class="form-control " id="bairro" name="bairro"
                            placeholder="Insira o nome do bairro" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="formGroup" class="form-label">Cidade:</label>
                        <input type="text" class="form-control " id="cidade" name="cidade"
                            placeholder="Insira o nome da cidade" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">UF:</label>
                        <input type="text" class="form-control " id="uf" name="uf"
                            placeholder="ex: RN" required>
                    </div>
                    <div class="mb-3 col-9">
                        <label for="formGroup" class="form-label">Complemento:</label>
                        <input type="text" class="form-control " id="complemento" name="complemento"
                            placeholder="Ponto de referência">
                    </div>
                </div>
                
                {{-- Contato --}}
                <div class="container row border-bottom border-primary mt-3">
                    <h2>Contato</h2>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Numero de Celular:</label>
                        <input type="text" class="form-control" maxlength="11" pattern="\d{10,11}" id="tel_celular"
                            name="tel_celular" placeholder="(xx) x xxxx-xxxx  Apenas numero" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Numero Residencial:</label>
                        <input type="text" class="form-control" maxlength="11" pattern="\d{10,11}"
                            id="tel_residencial" name="tel_residencial" placeholder="(xx) x xxxx-xxxx  Apenas numero">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Numero de Trabalho:</label>
                        <input type="text" class="form-control" maxlength="11" pattern="\d{10,11}" id="tel_trabalho"
                            name="tel_trabalho" placeholder="(xx) x xxxx-xxxx  Apenas numero">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="formGroup" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" 
                            placeholder="exemplo@email.com" required>
                    </div>
                </div>

                {{-- Dados Bancarios --}}
                <div class="container row border-bottom border-primary mt-3">
                    <h2>Dados Bancarios</h2>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Codigo:</label>
                        <input type="number" class="form-control" id="codigo" name="codigo">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Agencia:</label>
                        <input type="number" class="form-control" id="agencia" name="agencia">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Banco:</label>
                        <input type="text" class="form-control" id="banco" name="banco">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Conta:</label>
                        <input type="number" class="form-control" id="conta" name="conta">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Operação:</label>
                        <input type="number" class="form-control" id="operacao" name="operacao">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo">
                    </div>
                </div>

                {{-- Dados dos Militares --}}
                <div class="container row border-bottom border-primary mt-3">
                    <h2>Dados dos Militares</h2>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">Posto/Graduação:</label>
                        <select class="form-select " name="estado_civil" id="estado_civil">
                            <option selected disabled>Selecione</option>
                            <option value="civil">Civil</option>
                            <option value="soldado">Soldado</option>
                            <option value="cabo">Cabo</option>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Nome de Guerra:</label>
                        <input type="text" class="form-control" id="nome_guerra" name="nome_guerra">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Numero de praça:</label>
                        <input type="text" class="form-control" id="nmr_praca" name="nmr_praca">
                    </div>
                    <div class="mb-3 col-4">
                        <label for="formGroup" class="form-label">Matricula:</label>
                        <input type="text" class="form-control" id="matricula" name="matricula">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="formGroup" class="form-label">OPM:</label>
                        <select class="form-select " name="opm" id="opm">
                            <option selected disabled>Selecione</option>
                            <option value="1bpm">1°BPM</option>
                        </select>
                    </div>
                </div>

                {{-- Dependentes e Observações --}}
                <div class="container row border-bottom border-primary mt-3">
                    <h2>Dependentes</h2>
                    <label for="formGroup" class="form-label">Insira os nomes dos dependentes:</label>
                    <textarea name="dependentes" id="dependentes" cols="30" rows="5" maxlength="200"></textarea>
                </div>

                <div class="container row border-bottom border-primary mt-3">
                    <h2>Observações</h2>
                    <label for="formGroup" class="form-label">Insira os nomes dos dependentes:</label>
                    <textarea name="obs" id="obs" cols="30" rows="5" maxlength="200"></textarea>
                </div>

                <div class="container border-bottom border-primary mt-3 text-end">
                    <input type="submit" class="btn btn-primary mb-3" value=" Salvar ">
                </div>
            </form>
        </div>
    </div>

@endsection
