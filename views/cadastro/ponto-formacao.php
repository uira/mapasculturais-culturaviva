<?php
    $this->bodyProperties['ng-app'] = "culturaviva";
    $this->layout = 'cadastro';
    $this->cadastroTitle = '8. Formação';
    $this->cadastroText = 'Vamos compartilhar conhecimentos e experiências para fazer multiplicar os saberes da nossa cultura';
    $this->cadastroIcon = 'icon-book-open';
    $this->cadastroPageClass = 'formacao page-base-form';
    $this->cadastroLinkContinuar = '';

?>

<form ng-controller="PontoFormacaoCtrl">
    <?php $this->part('messages'); ?>
    <div class="form">
        <h4>Conhecimento em Rede</h4>
        <div class="row">
            <p>Pontos e Pontões de cultura também são formadores e multiplicadores de cultura. Esta parte do cadastro visa conectar conhecimentos e metodologias educativas,  de formação e aprendizagem desenvolvidas pelos Pontos e Pontões de Cultura, gerando uma grande Rede de Formação Livre Cultura Viva.</p>
            <p>O objetivo é mapear e sistematizar iniciativas de formação - formais e não formais, empíricas e teóricas, ancestrais e contemporâneas, urbanas e rurais - a fim de facilitar e ampliar as trocas de conhecimento na rede.</p>
            <p>As informações registradas neste cadastro farão parte de um banco de dados acessível a todos os Pontos e Pontões de Cultura, com o objetivo de estimular o intercâmbio de saberes.</p>
            <p class="destaque subtitle">Este  mapeamento prioriza as experiências produtivas no campo cultural e está dividido em 03 categorias:</p>
            <span class="destaque subtitle">1) Formadores: </span>
            <p>Formadores, professores, pesquisadores, mestres e mestras das culturas populare e tradicionais, arte-educadores e  investigadores que atuem no campo da cultura. </p>
            <span class="destaque subtitle">2) Espaços de Aprendizagem: </span>
            <p>Espaços culturais, sedes, eventos de formação e plataformas que possam ser consideradas espaços de aprendizagem.</p>
            <span class="destaque subtitle">3) Metodologias:</span>
            <p>Experiências de formação e aprendizagem, vivências, oficinas, cursos, palestras, dinâmicas de troca de conhecimento, entre outras metodologias.</p>
            <p>Para esta primeira etapa você poderá inscrever apenas 1 Formador, 1 Espaço de Aprendizagem e 1 Metodologia. Em breve, a segunda etapa estará pronta e você poderá complementar, inscrevendo mais formadores, espaços e metodologias referentes ao seu Ponto de Cultura.</p>

            <h4> Formadores</h4>
            <label class="colunm1">
                <span class="destaque">Nome Completo:</span>
                <input type="text">
            </label>
            <label class="colunm1">
                <span class="destaque">Email: </span>
                <input type="text">
            </label>
            <label class="colunm2">
                <span class="destaque">Telefone: </span>
                <input type="text" placeholder="(  )____-_____">
            </label>
            <label class="colunm2">
                <span class="destaque">Operadora: </span>
                <input type="text" >
            </label>
            <label class="colunm1">
                <span class="destaque">Áreas de atuação (oficinas/atividades ministradas):</span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span class="destaque">Descrição/Mini-bio:  </span>
                <textarea></textarea>
            </label>
            <div class="colunm-full">
                <span class="destaque redessociais">Seu perfil nas redes sociais: <i>?</i></span>
            </div>
            <label class="colunm-redes facebook">
                <span><i class="icon icon-facebook-squared"></i> Seu perfil no Facebook</span>
                <input type="text" ng-blur="save_field('facebook')" ng-model="agent.facebook" placeholder="http://"/>
            </label>

            <label class="colunm-redes twitter">
                <span><i class="icon icon-twitter"></i> Seu perfil no Twitter</span>
                <input type="text" ng-blur="save_field('twitter')" ng-model="agent.twitter" placeholder="http://"/>
            </label>

            <label class="colunm-redes googleplus">
                <span><i class="icon icon-gplus"></i> Seu perfil no Google+</span>
                <input type="text" ng-blur="save_field('googleplus')" ng-model="agent.googleplus" placeholder="http://"/>
            </label>

            <h4>Espaços de Aprendizagem</h4>

            <label class="colunm1">
                <span class="destaque">Áreas de atuação (oficinas/atividades ministradas):</span>
                <input type="text">
            </label>
            <div class="colunm-full">
                <span class="destaque">Que tipo de espaço/plataforma quer registrar?</span>
            </div>
            <label class="colunm-full">
                <input type="checkbox" name="" > Temporário (Por exemplo: Festival, seminário, encontro, evento digital ou presencial, entre outras)
            </label>
            <label class="colunm-full">
                <input type="checkbox" name="" > Permanente (Por exemplo:  Sede do Ponto de Cultura, espaços culturais onde podem ser realizadas atividades e processos formativos)
            </label>
            <label class="colunm1">
                <span class="destaque">Descreva o espaço (Cite atividades realizadas, público alcançado, periodicidade de ações):</span>
                <input type="text">
            </label>

            <h4> Metodologias</h4>

            <label class="colunm-full">
                <span class="destaque">Nome da metodologia: </span>
                <input type="text">
            </label>
            <label class="colunm-full">
                <span class="destaque">Descrição:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm-full">
                <span class="destaque">Necessidades técnicas:  </span>
                <textarea></textarea>
            </label>
            <label class="colunm1">
                <span class="destaque">Capacidade de público:  </span>
                 <input type="text">
            </label>
            <label class="colunm1">
                <span class="destaque">Carga horária:  </span>
                 <input type="text">
            </label>
            <label class="colunm-full">
                <span class="destaque">Possui certificação?</span>
            </label>
            <div class="colunm-50">
                <label class="label-radio"><input type="radio" name="certificacao"> Sim</label>
                <label class="label-radio"><input type="radio" name="certificacao"> Não </label>
            </div>
            <div class="colunm-full">
                <span class="destaque">Tipo de Metodologia</span>
            </div>
            <div class="colunm-full">
            <label class="colunm3">
                <input type="checkbox" name="" > Não formal
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Conhecimento popular
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Conhecimento empírico
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Outro. Qual?
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Acadêmica
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Ensino básico
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Ensino médio
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Ensino superior
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Graduação
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Pós-graduação
            </label>
          </div>
        </div>
        <!--<div class="row">

                <h4>Áreas de atuação</h4>

            <div class="row">
                <span class="destaque">Especifique a área de experiência e temas que você pode compartilhar conhecimento:*</span>
            </div>
            <label class="colunm1">
                <input type="checkbox" name="" > Produção Cultural
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Artes Cênicas
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Artes Visuais
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Artesanato
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Audiovisual
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Capacitação
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Capoeira
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Contador de Histórias
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Cultura Afro
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Cultura Alimentar
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Cultura Digital
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Culturas Indígenas
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Culturas Populares
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Comunicação
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Direitos Humanos
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Esporte
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Fotografia
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Gastronomia
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Gênero
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Hip Hop
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Juventude
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Literatura
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Meio Ambiente
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Moda
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Música
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Software Livre
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Tradição Oral
            </label>
            <label class="colunm1">
                <input type="checkbox" name="" > Turismo
            </label>
            <label class="colunm2">
                <input type="checkbox" name="" > Internacional
            </label>
            <label class="colunm3">
                <input type="checkbox" name="" > Outros. Quais?
            </label>
        </div> -->
    </div>
</form>
