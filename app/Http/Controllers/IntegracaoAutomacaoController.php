<?php

namespace App\Http\Controllers;

use App\Bico;
use App\Produto;
use App\Veiculo;
use App\Atendente;
use App\Abastecimento;
use App\TanqueMovimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AbastecimentoController;

class IntegracaoAutomacaoController extends Controller
{
    /* 
        funcionarios.hir - Cadastro de Funcionarios

        <VersaoRegistro;IdentificacaoFuncionario;Nome>

        Onde:
        < = Caracter marcador de inicio de regsitro
        Versao do Registro = 01 - Versao do layout do registro (2 caracteres Numericos)
        Identificacao Funcionario = 16 caracteres alfa numericos
        Nome = Nome do funcionario (10 caracteres alfa numericos)
        > = Caracter marcador de fim de regsitro
    */
    public function ExportarAtendentes() {
        $conteudo = '';
        $atendentes = Atendente::where('ativo', true)->get();
        foreach ($atendentes as $atendente) {
            $conteudo = '<01;';
            $conteudo .= substr('                '.$atendente->senha_atendente, -16).';';
            $conteudo .= substr('          '.$atendente->usuario_atendente, -10).';';
            $conteudo .= '>';
        }

        $conteudo = $this->cryptAPI($conteudo);

        dd($conteudo);
        //Storage::disk('ftp')->put('funcionarios.hir', $conteudo);
    }

    /* 
    produtos.hir  -  Cadastro de produtos

    <VersaoRegistro;CodigoProduto;Descricao>

    Onde:
    < = Caracter marcador de inicio de regsitro
    Versao do Registro = 01 - Versao do layout do registro (2 caracteres Numericos)
    Codigo do produto = Produto (3 caracteres Numericos 1 - 999)
    Descricao = Descricao do Produto (10 caracteres alfa numericos)
    > = Caracter marcador de fim de regsitro
    */

    public function ExportarProdutos() {
        $conteudo = '';
        $produtos = Produto::where('ativo', true)->get();
        foreach ($produtos as $produto) {
            $conteudo .= '<01;';
            $conteudo .= substr('   '.$produto->id, -3).';';
            $conteudo .= substr('          '.$produto->produto_desc_red, -10).';';
            $conteudo .= '>';
        }

        $conteudo = $this->cryptAPI($conteudo);

        Storage::disk('ftp')->put('produtos.hir', $conteudo);
    }


    /* 
    veiculos.hir - Cadastro de veiculos
    
    <VersaoRegistro;IdentificacaoVeiculo;;TagVeiculo>
    
    Onde:
    < = Caracter marcador de inicio de regsitro
    Versao do Registro = 01 - Versao do layout do registro (2 caracteres Numericos)
    Identificacao Veiculo = placa ou prefixo do veiculo (16 caracteres alfa numericos)
    Tag Veiculo = Tag do veiculo (8 caracteres alfa numericos)
    > = Caracter marcador de fim de regsitro 
    */
    
    public function ExportarVeiculos() {
        $conteudo = '';
        $veiculos = Veiculo::where('ativo', true)->get();
        foreach ($veiculos as $veiculo) {
            $conteudo .= '<01;';
            $conteudo .= substr('                '.$veiculo->placa, -16).';';
            $conteudo .= substr('        '.$veiculo->tag, -8);
            $conteudo .= '>';
        }

        $conteudo = $this->cryptAPI($conteudo);

        Storage::disk('ftp')->put('veiculos.hir', $conteudo);
    }

    public function Exportar() {
        $this->ExportarAtendentes();
        $this->ExportarProdutos();
        $this->ExportarVeiculos();

        Session::flash('success', 'Dados Exportados com sucesso!');
        return redirect()->action('HomeController@index');
    }

    public function teste() {
        $data = $this->cryptAPI("VZ[QJJJJJJJJSZ+YR,]+QJJJJJJ'\x1F\x0E\x05QT");
        dd($data);
        $result = array();

        $abastecidas = explode('>', $data);
        foreach ($abastecidas as $abastecida) {
            $abastecida = str_replace('<', '', $abastecida);
            $abastecida = explode(';', $abastecida);
            if (count($abastecida) > 1) {
                $result[] = ($abastecida);
            }
        }

        $b = null;
        foreach (str_split($result[1][4].$result[0][5], 2) as $a) {
            $b .= $b ? '-' : '';
            $b .= trim($a);
        }

        $data_hora = \DateTime::createFromFormat('j-n-y-H-i-s', $b);

        //dd($result);
        dd($data_hora->format('Y-m-d H:i:s'));

        return $result;
    }

    protected function formataDataHoraAbastecimento(String $dataHora) {
        $b = null;
        $dataHora = str_replace(' ', '0', $dataHora);
        foreach (str_split($dataHora, 2) as $a) {
            $b .= $b ? '-' : '';
            $b .= trim($a);
        }
        return \DateTime::createFromFormat('d-m-y-H-i-s', $b);
    }

    protected function formataValorDecimal($valor, $numCasas = 2) {
        if ($numCasas > 0) {            
            return floatval(substr($valor, 0, ($numCasas * -1)).'.'.substr($valor, ($numCasas * -1)));
        } else {
            return floatval($valor);
        }
    }

    protected function formataPlacaVeiculo($placa) {
        return strtoupper(substr($placa, 0, -4).'-'.substr($placa, -4));
    }

    /* 
    abastecimentos.hir - Arquivo de Abastecimentos:							
    <VersaoRegistro;ID;NS;Bico;Data;Hora;ValorAbastecido;VolumeAbastecido;PrecoUnitario;CasaDecimalPU;EncerranteInicial;EncerranteFinal;
    IdentificacaoFuncionario;IdentificacaoVeiculo;TagVeiculo;Km;Requisicao>

    Onde:
    < = Caracter marcador de inicio de regsitro
    0 - Versao do Registro = 01 - Versao do layout do registro (2 caracteres Numericos) 
    1 - ID = Identificacao do registro de abastecimento (10 caracteres Numericos 1 - 4.294.967.295)
    2 - NS = Numero de serie do Hiro (10 caracteres Numericos 1 - 4.294.967.295)
    3 - Bico = Bico que fez o abastecimento (2 caracteres Numericos 1 - 99)
    4 - Data = Ano Mes Dia (6 caracteres Numericos)
    5 - Hora = Hora Minuto Segundo (6 caracteres Numericos)
    6 - Valor Abastecido = Valor (8 caracteres Numericos sendo 2 decimais)
    7 - Volume Abastecido = Volume (8 caracteres Numericos sendo 3 decimais)
    8 - Preco Unitario = Preco (4 caracteres Numericos)
    9 - Casa Decimal = Numero de casas decimais (1 caracter Numericos 0 - 3)
    10 - Encerrante Inicial = 10 caracteres Numericos sendo 2 decimais
    11 - Encerrante Final = 10 caracteres Numericos sendo 2 decimais
    12 - Identificacao Funcionario = 16 caracteres alfa numericos
    13 - Identificacao Veiculo = placa ou prefixo do veiculo (16 caracteres alfa numericos)
    14 - Tag Veiculo = Tag do veiculo (8 caracteres alfa numericos)
    15 - km = 10 caracteres Numericos sendo 1 decimal
    16 - Requisicao = 16 caracteres alfa numericos
    > = Caracter marcador de fim de regsitro
    */
    public function ImportarAbastecimentos() {
        if (Storage::disk('ftp')->exists('abastecimentos.hir')) {
            try {
                $arquivo = Storage::disk('ftp')->get('abastecimentos.hir');
                $arquivo = $this->cryptAPI($arquivo);

                $registros = array();
                
                $linhas = explode('>', $arquivo);
                foreach ($linhas as $linha) {
                    $linha = str_replace('<', '', $linha);
                    $linha = explode(';', $linha);
                    if (count($linha) > 1) {
                        $registros[] = $linha;
                    }
                }
                //$dataInicio = \DateTime::createFromFormat('Y-m-d H:i:s', '2018-03-28 09:00:01');
                $dataInicio = \DateTime::createFromFormat('Y-m-d H:i:s', 
                                    Abastecimento::whereNotNull('id_automacao')
                                            ->orderBy('data_hora_abastecimento', 'desc')
                                            ->pluck('data_hora_abastecimento')
                                            ->first());
                //dd($dataInicio);
                foreach ($registros as $registro)  {
                    if (count($registro) == 17) {
                        try {
                            $abastecimento = new Abastecimento;
                            $abastecimentoController = new AbastecimentoController;
                            $obs = null;
    
                            $atendente = Atendente::where('usuario_atendente', '=', trim($registro[12]))->first();
                            $bico = Bico::where('num_bico', '=', trim($registro[3]))->first();
                            $veiculo = Veiculo::where('placa', '=', $this->formataPlacaVeiculo(trim($registro[13])))->first();
    
    
                            if (!$bico) {   
                                $obs .= 'Bico ['.trim($registro[3]).']: Não encontrado!&#10;';
                            } else {
                                $abastecimento->bico_id = $bico->id;
                            }
    
                            if (!$atendente) {
                                $obs .= 'Atendente ['.trim($registro[12]).']: Não encontrado!&#10;';
                            } else {
                                $abastecimento->atendente_id = $atendente->id;
                            }
    
                            $abastecimento->id_automacao = trim($registro[1]);
                            $abastecimento->ns_automacao = trim($registro[2]);           
                            $abastecimento->data_hora_abastecimento = $this->formataDataHoraAbastecimento($registro[4].$registro[5])->format('Y-m-d H:i:s');
                            
                            /*if ($abastecimento->data_hora_abasteciemento > '2018-03-18 23:59:59') {
                                dd('é maior '.$abastecimento->data_hora_abastecimento);
                            } else {
                                continue;
                            }*/
                            
                            $abastecimento->valor_abastecimento = $this->formataValorDecimal(trim($registro[6]));
                            $abastecimento->volume_abastecimento = $this->formataValorDecimal(trim($registro[7]), 3);
                            $abastecimento->valor_litro = $this->formataValorDecimal(trim($registro[8]), trim($registro[9]));
                            $abastecimento->encerrante_inicial = $this->formataValorDecimal(trim($registro[10]));
                            $abastecimento->encerrante_final = $this->formataValorDecimal(trim($registro[11]));
                            $abastecimento->km_veiculo = $this->formataValorDecimal(trim($registro[15]), 1);
    
                            /* se valor total zerado, calcula valor total */
                            if ($abastecimento->valor_abastecimento == 0) {
                                $abastecimento->valor_abastecimento = round($abastecimento->volume_abastecimento * $abastecimento->valor_litro, 2);
                            }
    
                            if (!$veiculo) {
                                $obs .= 'Veículo ['.trim($registro[14]).']: Não encontrado!&#10;';
                                $abastecimento->media_veiculo = 0;
                            } else {
                                $abastecimento->veiculo_id = $veiculo->id;
                                $abastecimento->media_veiculo = $abastecimentoController->obterMediaVeiculo($veiculo, $abastecimento);
                            }
    
                            if ($abastecimento->km_veiculo <= 0) {
                                $obs .= 'KM não informada para.&#10;';
                            }
                            
                            if ($obs){
                                $obs = 'Inconsistências encontradas, verifique.&#10;'.$obs;
                                $abastecimento->obs_abastecimento = $obs;
                                $abastecimento->inconsistencias_importacao = true;
                            } 
                            
                            $dataAbastecimento =$this->formataDataHoraAbastecimento($registro[4].$registro[5]);

                            if ( $dataAbastecimento < $dataInicio) {
                                //Log::info('id_automacao: '.$registro[1].' Já existe na base de dados');
                                continue;
                            } 
                           /*  if (Abastecimento::where('id_automacao', '=', trim($registro[1]))->where('data_hora_abastecimento', '=', $abastecimento->data_hora_abastecimento)->count() > 0) {
                                //Log::info('id_automacao: '.$registro[1].' Já existe na base de dados');
                                continue;
                            } */
                        } catch (\Exception $e) {
                            Log::info($e);
                        }
                        
                        //dd($abastecimento);

                        DB::transaction(function($dados) use ($abastecimento, $bico) {
                            $movimentacao = new TanqueMovimentacao;
                            $movimentacao->entrada_combustivel = false;
                            $movimentacao->data_movimentacao = $abastecimento->data_hora_abastecimento;
                            $movimentacao->documento = 'ABAST'.$abastecimento->id_automacao;
                            $movimentacao->tanque_id = $bico->tanque_id;
                            $movimentacao->quantidade_combustivel = $abastecimento->volume_abastecimento;

                            if ($movimentacao->save()) {
                                $abastecimento->tanque_movimentacao_id = $movimentacao->id;
                                $abastecimento->save();
                            }
                            Log::info('salvou: '.$abastecimento);
                        });   
                    } else {
                        Log::alert('Erro ao importar registro: '.implode("|",$registro), []);
                    }
                }
            } finally {
                //$this->limparArquivoAbastecimentosServidor();
            }
            
            Session::flash('success', 'Abastecimentos Importados com sucesso!');
            return redirect()->action('AbastecimentoController@index');
        } else {
            Session::flash('success', 'Não existem abastecimentos a serem importados!');
            return redirect()->action('AbastecimentoController@index');
        }
    }


    protected function limparArquivoAbastecimentosServidor() {
        if (!Storage::disk('ftp')->delete('abastecimentos.hir')) {
            Log::alert('Não foi possível apagar o arquivo abastecimentos.hir do servidor...', []);
        }
    }

    protected function cryptAPI($data) {
        $key = 106;
        $result = null;

        $bytes = unpack('C*', $data);

        foreach ($bytes as $byte) {
            $result .= pack('C*', $byte ^ $key);
        }

        return $result;
    }
}