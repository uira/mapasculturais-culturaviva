<?php
namespace CulturaViva\Controllers;

use MapasCulturais\App;

class Cadastro extends \MapasCulturais\Controller{
    /**
     * Objeto com os ids dos agentes, inscrição e se o usuário informou um cnpj ou não.
     *
     * @var stdClass
     */
    protected $_usermeta = null;

    /**
     * Inscrição no edital Cultura Viva
     * @var \MapasCulturais\Entities\Registration
     */
    protected $_inscricao = null;

    /**
     * Agente individual (Responsável pelo Ponto de Cultura)
     * @var \MapasCulturais\Entities\Agent
     */
    protected $_responsavel = null;

    /**
     * Agente coletivo (Entidade)
     * @var \MapasCulturais\Entities\Agent
     */
    protected $_entidade = null;

    /**
     * Agente coletivo (Ponto/Pontão de Cultura)
     * @var \MapasCulturais\Entities\Agent
     */
    protected $_ponto = null;

    protected function __construct() {
        $app = App::i();

        if (!$app->user->is('guest')) {
            $this->_usermeta = json_decode($app->user->redeCulturaViva);

            if($this->_usermeta) {

                $this->_inscricao   = $app->repo('Registration')->find($this->_usermeta->inscricao);
                $this->_responsavel = $app->repo('Agent')->find($this->_usermeta->agenteIndividual);
                $this->_entidade    = $app->repo('Agent')->find($this->_usermeta->agenteEntidade);
                $this->_ponto       = $app->repo('Agent')->find($this->_usermeta->agentePonto);
            }
        }
    }

    /**
     * Objeto com os ids dos agentes, inscrição e se o usuário informou um cnpj ou não.
     *
     * @return stdClass
     */
    function getUsermeta (){
        return $this->_usermeta;
    }

    /**
     * Inscrição no edital Cultura Viva
     * @return \MapasCulturais\Entities\Registration
     */
    function getInscricao(){
        return $this->_inscricao;
    }

    /**
     * Agente individual (Responsável pelo Ponto de Cultura)
     * @return \MapasCulturais\Entities\Agent
     */
    function getResponsavel(){
        return $this->_responsavel;
    }

    /**
     * Agente coletivo (Entidade)
     * @return \MapasCulturais\Entities\Agent
     */
    function getEntidade(){
        return $this->_entidade;
    }

    /**
     * Agente coletivo (Ponto/Pontão de Cultura)
     * @return \MapasCulturais\Entities\Agent
     */
    function getPonto(){
        return $this->_ponto;
    }

    /**
     * Propriedades obrigatórias do Ponto/Pontão de Cultura
     * @return array
     */
    function getPontoRequiredProperties(){
        return [
            'name',
            'shortDescription',
            'cep',
            'tem_sede',
            'geoEstado',
            'geoMunicipio',
            'En_Bairro',
            'En_Num',
            'En_Nome_Logradouro',
            'location', // ponto no mapa

            //portifólio
            'atividadesEmRealizacao'
        ];
    }

    /**
     * Propriedades obrigatórias da Entidade
     * @return array
     */
    function getEntidadeRequiredProperties(){
        $agent = $this->getEntidade();
        $required_properties = [
            'name',
            'tipoOrganizacao',
            'foiFomentado',
            'fomento_tipo',
            'fomento_tipo_outros',
            'fomento_tipoReconhecimento',
            'edital_num',
            'edital_ano',
            'edital_projeto_nome',
            'edital_localRealizacao',
            'edital_projeto_etapa',
            'edital_proponente',
            'edital_projeto_resumo',
            'edital_prestacaoContas_envio',
            'edital_projeto_vigencia_inicio',
            'edital_projeto_vigencia_fim',
            'outrosFinanciamentos',

        ];

        if(!$agent->semCNPJ){
            $required_properties[] = 'cnpj';
            $required_properties[] = 'nomeCompleto';
        }

        if($agent->edital_prestacaoContas_envio === 'enviada'){
            $required_properties[] = 'edital_prestacaoContas_status';
        }

        return $required_properties;
    }

    /**
     * Propriedades Obrigatórias do Agente Responsável
     * @return array
     */
    function getResponsavelRequiredProperties(){
        return [
            'nomeCompleto',
            'relacaoPonto',
            'cpf',
            'emailPrivado',
            'telefone1',
            'telefone1_operadora',
            'relacaoPonto'
        ];
    }

    /**
     * Verifica se o usuário está logado e tem o metadado 'redeCulturaViva'.
     * Se não tiver redireciona para a action rede.index
     */
    protected function _validateUser(){
        $this->requireAuthentication();

        $app = App::i();

        if(!$app->user->redeCulturaViva){
            $app->redirect($app->createUrl('rede', 'entrada'), 307);
        }
    }

    protected function _checkPermissionsToViewErrors($agent){
        $this->requireAuthentication();
        $agent->checkPermission('@control');
    }

    protected function _getErrors(\MapasCulturais\Entities\Agent $entity, array $required_properties, array $required_taxonomies = []){
        $errors = [];
        foreach($required_properties as $prop){
            if(is_null($entity->$prop) || $entity->$prop === ''){
                $errors[] = $prop;
            }
        }

        return $errors;
    }

    function getErrorsResponsavel(){
        $agent = $this->getResponsavel();
        $this->_checkPermissionsToViewErrors($agent);
        $required_properties = $this->getResponsavelRequiredProperties();


        return $this->_getErrors($agent, $required_properties);
    }

    function getErrorsEntidade(){
        $agent = $this->getEntidade();
        $this->_checkPermissionsToViewErrors($agent);
        $required_properties = $this->getEntidadeRequiredProperties();

        return $this->_getErrors($agent, $required_properties);
    }

    function getErrorsPonto(){
        $agent = $this->getPonto();
        $this->_checkPermissionsToViewErrors($agent);
        $required_properties = $this->getPontoRequiredProperties();

        return $this->_getErrors($agent, $required_properties);
    }

    protected function _populateAgents($responsavel, $entidade, $ponto){
        $app = App::i();

        $api_url = $app->config['rcv.apiCNPJ'] . '?action=get_cultura&cnpj=' . $this->data['CNPJ'];
        $d = json_decode(file_get_contents($api_url));
        if(is_object($d)){
            // responsável
            $responsavel->nomeCompleto  = $d->Nm_Responsavel;
            $responsavel->emailPrivado  = $d->Ee_email_reponsavel;

            // entidade
            $entidade->name             = $d->Nm_Entidade;
            $entidade->nomeCompleto     = $d->Nm_Entidade;

            $entidade->rcv_Cod_pronac   = $d->Cod_pronac;
            $entidade->rcv_Cod_salic    = $d->Cod_salic;
            $entidade->rcv_Cod_scdc     = $d->Cod_scdc;


            $entidade->foiFomentado = '1';
            $entidade->tipoPontoCulturaDesejado = $d->Ds_Instrumento === 'Pontão' ? 'pontao' : strtolower($d->Ds_Instrumento);

            if($d->Ds_Tipo_ponto === 'Direto'){
                $entidade->tipoReconhecimento = 'minc';
            }else if($d->Ds_Tipo_ponto === 'Rede'){
                $entidade->tipoReconhecimento = strtolower($d->Id_Tipo_Esfera);
            }else if($d->Id_Tipo_Esfera === 'Estadual' || $d->Id_Tipo_Esfera === 'Municipal'){
                $entidade->tipoReconhecimento = strtolower($d->Id_Tipo_Esfera);
            } else {
                $entidade->tipoReconhecimento = 'outros';
            }

            $_location = ['latitude' => (float)$d->Id_Latitude, 'longitude' => (float)$d->Id_Longitude];


            $entidade->rcv_Ds_Edital       = $d->Ds_Edital;
            $entidade->rcv_Ds_Tipo_ponto   = $d->Ds_Tipo_ponto;
            $entidade->rcv_Id_Tipo_Esfera  = $d->Id_Tipo_Esfera;


            $entidade->telefonePublico     = $d->Nr_DDD1 . ' ' . $d->Nr_Telefone1;
            $entidade->telefone1           = $d->Nr_DDD2 . ' ' . $d->Nr_Telefone2;
            $entidade->telefone2           = $d->Nr_DDD3 . ' ' . $d->Nr_Telefone3;

            $entidade->site                = $d->Lk_Site;

            $entidade->location            = $_location;
            $entidade->En_Nome_Logradouro  = $d->En_Nome_Logradouro;
            $entidade->En_Num              = $d->En_Km ? $d->En_Km : $d->En_Num;
            $entidade->En_Complemento      = $d->En_Complemento;
            $entidade->En_Bairro           = $d->En_Bairro;
            $entidade->cep                 = $d->End_CEP;
            $entidade->endereco            = $d->En_Endereco_Original;
            $entidade->geoEstado           = $d->Sg_UF;
            $entidade->geoMunicipio        = $d->Nm_Municipio;

            $entidade->emailPrivado        = $d->Ee_email1;
            $entidade->emailPrivado2       = $d->Ee_email2;
            $entidade->emailPrivado3       = $d->Ee_email3;


            // ponto
            $ponto->name                = $d->Nm_Ponto;

            $ponto->telefonePublico     = $d->Nr_DDD1 . ' ' . $d->Nr_Telefone1;
            $ponto->telefone1           = $d->Nr_DDD2 . ' ' . $d->Nr_Telefone2;
            $ponto->telefone2           = $d->Nr_DDD3 . ' ' . $d->Nr_Telefone3;

            $ponto->site                = $d->Lk_Site;

            $ponto->location            = $_location;
            $ponto->En_Nome_Logradouro  = $d->En_Nome_Logradouro;
            $ponto->En_Num              = $d->En_Km ? $d->En_Km : $d->En_Num;
            $ponto->En_Complemento      = $d->En_Complemento;
            $ponto->En_Bairro           = $d->En_Bairro;
            $ponto->cep                 = $d->End_CEP;
            $ponto->endereco            = $d->En_Endereco_Original;
            $ponto->geoEstado           = $d->Sg_UF;
            $ponto->geoMunicipio        = $d->Nm_Municipio;

            $ponto->emailPrivado        = $d->Ee_email1;
            $ponto->emailPrivado2       = $d->Ee_email2;
            $ponto->emailPrivado3       = $d->Ee_email3;
        }
        
    }


    function ALL_index(){
        $this->_validateUser();

        $this->render('index');
    }

    function GET_responsavel(){
        $this->_validateUser();

        $this->render('responsavel');
    }

    function GET_entidadeDados(){
        $this->_validateUser();

        $this->render('entidade-dados');
    }

    function GET_entidadeFinanciamento(){
        $this->_validateUser();

        $this->render('entidade-financiamento');
    }

    function GET_pontoMapa(){
        $this->_validateUser();

        $this->render('ponto-mapa');
    }

    function GET_portifolio(){
        $this->_validateUser();

        $this->render('portifolio');
    }

    function GET_articulacao(){
        $this->_validateUser();

        $this->render('ponto-articulacao');
    }

    function GET_economiaViva(){
        $this->_validateUser();

        $this->render('ponto-economia-viva');
    }

    function GET_formacao(){
        $this->_validateUser();

        $this->render('ponto-formacao');
    }

    function GET_pogressio(){
        echo 'Grande Adoniram Barbosa!!!';die;
    }

    function ALL_registra(){
        $this->requireAuthentication();
        $app = App::i();

        if(!$app->user->redeCulturaViva){
            $user = $app->user;

            $project = $app->repo('Project')->find($app->config['redeCulturaViva.projectId']); //By(['owner' => 1], ['id' => 'asc'], 1);
            //
            // define o agente padrão (profile) como rascunho
            $app->disableAccessControl(); // não sei se é necessário desabilitar

            // criando o agente coletivo vazio
            $entidade = new \MapasCulturais\Entities\Agent;
            $entidade->type = 2;
            $entidade->parent = $user->profile;
            $entidade->name = '';
            $entidade->status = \MapasCulturais\Entities\Agent::STATUS_DRAFT;
            

            // criando o agente coletivo vazio
            $ponto = new \MapasCulturais\Entities\Agent;
            $ponto->type = 2;
            $ponto->parent = $user->profile;
            $ponto->name = '';
            $ponto->status = \MapasCulturais\Entities\Agent::STATUS_DRAFT;

            if(isset($this->data['comCNPJ']) && $this->data['comCNPJ'] && isset($this->data['CNPJ']) && $this->data['CNPJ']){
                $entidade->cnpj = $this->data['CNPJ'];
                $entidade->tipoOrganizacao = 'entidade';
                $this->_populateAgents($app->user->profile, $entidade, $ponto);
            }   
            
            $ponto->save(true);
            $entidade->save(true);
            $app->user->profile->save(true);

            // criando a inscrição

            // relaciona o agente responsável, que é o proprietário da inscrição
            $registration = new \MapasCulturais\Entities\Registration;
            $registration->owner = $user->profile;
            $registration->project = $project;

            // inserir que as inscricoes online estao ativadas
            $registration->save(true);

            $user->redeCulturaViva = json_encode([
                'agenteIndividual' => $user->profile->id,
                'agenteEntidade' => $entidade->id,
                'agentePonto' => $ponto->id,
                'inscricao' => $registration->id,
                'comCNPJ' => isset($this->data['comCNPJ']) && $this->data['comCNPJ']
            ]);

            $user->save(true);

            // relaciona o agente coletivo
            $registration->createAgentRelation($entidade, 'entidade', false, true, true);
            $registration->createAgentRelation($ponto, 'ponto', false, true, true);

            $app->enableAccessControl();
        }
        
        if($app->request->isAjax()){
            $this->json(true);
        }else{
            $app->redirect($app->createUrl('cadastro','index'),307);
        }
    }

    function GET_errosResponsavel(){
        $this->json($this->getErrorsResponsavel());
    }

    function GET_errosEntidade(){
        $this->json($this->getErrorsEntidade());
    }

    function GET_errosPonto(){
        $this->json($this->getErrorsPonto());
    }

    function ALL_enviar(){
        $inscricao = $this->getInscricao();

        if($inscricao){
            $inscricao->checkPermission('send');
        }else{
            $this->errorJson('O usuário ainda não fez o cadastro na rede', 400);
        }

        $erros_responsavel = $this->getErrorsResponsavel();
        $erros_entidade = $this->getErrorsEntidade();
        $erros_ponto = $this->getErrorsPonto();

        if(!$erros_responsavel && !$erros_entidade && !$erros_ponto){
            $responsavel = $this->getResponsavel();
            $entidade = $this->getEntidade();
            $ponto = $this->getPonto();

            $responsavel->publish(true);
            $entidade->publish(true);
            $ponto->publish(true);

            if($ponto->sede_realizaAtividades){
                if($ponto->rcv_sede_spaceId){
                    $espaco = App::i()->repo('Space')->find($ponto->rcv_sede_spaceId);
                }else{
                    $espaco = new \MapasCulturais\Entities\Space;
                }
                $espaco->type = 125; // ponto de cultura
                $espaco->owner = $ponto;
                $espaco->name = $ponto->name;
                $espaco->nomeCompleto = $ponto->nomeCompleto;
                $espaco->shortDescription = $ponto->shortDescription;
                $espaco->longDescription = $ponto->longDescription;
                $espaco->location = $ponto->location;
                $espaco->geoEstado = $ponto->geoEstado;
                $espaco->geoMunicipio = $ponto->geoMunicipio;
                $espaco->En_Bairro = $ponto->En_Bairro;
                $espaco->En_Num = $ponto->En_Num;
                $espaco->En_Nome_Logradouro = $ponto->En_Nome_Logradouro;
                $espaco->En_Complemento = $ponto->En_Complemento;
                $espaco->endereco = "{$espaco->En_Nome_Logradouro} {$espaco->En_Num}, {$espaco->En_Bairro}, {$espaco->geoMunicipio}, {$espaco->geoEstado}";
                $espaco->terms = $ponto->terms;

                $espaco->save(true);
                if(!$ponto->rcv_sede_spaceId){
                    $ponto->rcv_sede_spaceId = $espaco->id;
                    $ponto->save(true);
                }

            }

            $inscricao->send();

        } else {
            $this->errorJson([
                'responsavel' => $erros_responsavel,
                'entidade' => $erros_entidade,
                'ponto' => $erros_ponto
            ], 400);
        }
    }
}
