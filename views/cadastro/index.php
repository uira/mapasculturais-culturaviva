<?php
$this->bodyProperties['ng-app'] = "culturaviva";
?>
<div id="page-cadastro" ng-controller="DashboardCtrl">
    <section class="texto">
<!--        <div class="messenger">
            <a href="#" class="close">X</a>
            <p>Algumas informações já foram preenchidas de acordo com o cadastro que o MinC possui de seu Ponto. Confira com essas informações antes de validá-las!</p>
        </div>
        1. Informações do Responsável
        2. Entidade ou Coletivo Cultural
        3. Projetos Financiados
        4. Seu Ponto no Mapa
        5. Portifólio e Anexos
        6. Atuação e Articulação
        7. Economia Viva
        8. Formação
-->
        <article>
            <h2>Seja bem vindo(a) <br>à Rede Cultura Viva</h2>
            <p>Esta é a página do seu Ponto de Cultura. Apenas você tem acesso a ela.</p>
            <p>Fique a vontade para ir preenchendo as sessões. Você não precisa fazer tudo agora! Quando sua página estiver completa clique em "Enviar".</p>
            <p>Depois, seu ponto poderá criar eventos, projetos e usar a plataforma para se manter em contato com o Ministério da Cultura.</p>
        </article>
    </section>
    <section class="boxs-cadastro">
        <a href="<?php echo $app->createUrl('cadastro', 'responsavel'); ?>">
        <article class="box-info-responsavel">
            <header>
              <span class="icon icon-user"></span>
              <h4> 1. Informações do Responsável</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
              <div class="texto">
                <p>Precisamos saber quem é você e pegar seus contatos</p>
              </div>
<!--                <div class="circle-status c100 p56 small">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'entidadeDados'); ?>">
        <article class="box-entidade-dados border-left">
            <header>
                <span class="icon icon-home"></span>
                <h4> 2. Entidade ou Coletivo Cultural</h4>
                <span class="btn_mais"> + </span>

            </header>
            <div class="infos">
                <div class="texto">
                     <p>Conte mais sobre sua organização</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'entidadeFinanciamento'); ?>">
        <article class="box-entidade-financiados">
            <header>
              <span class="icon icon-dollar"></span>
              <h4> 3. Projetos Financiados</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Já recebeu recursos do Ministério da Cultura? </p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'pontoMapa'); ?>">
        <article class="box-ponto-mapa border-left">
            <header>
                    <span class="icon icon-location"></span>
                    <h4> 4. Seu Ponto no Mapa</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
                <div class="texto">
                     <p>Mostre onde você atua</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'portifolio'); ?>">
        <article class="box-portfolio">
            <header>
              <span class="icon icon-picture"></span>
              <h4> 5. Portifólio e Anexos</h4>
              <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
                <div class="texto">
                     <p>Anexe os documentos obrigatórios para a autodeclaração</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'articulacao'); ?>">
        <article class="box-atuacao-articulaco border-left">
            <header>
                    <span class="icon icon-chat"></span>
                    <h4> 6. Atuação e Articulação</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Fale um pouco mais sobre as atividades realizadas pelo seu Ponto</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'economiaViva'); ?>">
        <article class="box-economia-viva">
            <header>
                    <span class="icon icon-vcard"></span>
                    <h4> 7. Economia Viva</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Compartilhe recursos e serviços</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <a href="<?php echo $app->createUrl('cadastro', 'formacao'); ?>">
        <article class="box-formacao border-left">
            <header>
                    <span class="icon icon-book-open"></span>
                    <h4> 8. Formação</h4>
                    <span class="btn_mais"> + </span>
            </header>
            <div class="infos">
               <div class="texto">
                     <p>Conecte conhecimentos e metodologias</p>
                </div>
<!--                <div class="circle-status c100 p56">
                    <span>56%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>-->
            </div>
        </article>
        </a>
        <div class="clear"></div>
    </section>
    <section class="box-status">
        <article class="validar-ponto">
<!--            <h4><i class="icon-publish"> </i> Enviar </h4>-->
            <label class="colunm-full" style="color:#FFF">
              <p>
                <input type="checkbox" name="termos" ng-model="termos_de_uso" >   Aceito os <a href="/privacidade-e-termos-de-uso/" style="color:#FFF"> Termos de Uso e Privacidade</a> e o <a href="/termo-de-adesao/" style="color:#FFF">Termo de Adesão à Política Nacional de Cultura Viva </a>
                <!-- textarea></textarea -->
              </p>
            </label>
            <p>Para validar seu ponto, você precisa preencher todas as informações obrigatórias.</p>
            <div class="clear"></div>
        </article>
        <article class="content-status">

        <?php /*
        <article class="content-status">
            <div class="status">

                <div class="circle-status c100 p13">
                    <span>13%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-user"></span>
                <p>Informações do Responsável<br />(45% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p65">
                    <span>65%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-home"></span>
                <p>Entidade ou Coletivo Cultural<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p13">
                    <span>13%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-dollar"></span>
                <p>Projetos Financiados<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p100">
                    <span>100%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-location"></span>
                <p>Seu Ponto no Mapa<br />(100% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p50">
                    <span>50%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-picture"></span>
                <p>Portifólio e Anexos<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p100">
                    <span>100%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-chat"></span>
                <p>Atuação e Articulação<br />(100% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p55">
                    <span>55%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-vcard"></span>
                <p>Economia Viva<br />(50% informações opcionais)</p>
            </div>
            <div class="status">

                <div class="circle-status c100 p90">
                    <span>90%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>

                <span class="icon icon-book-open"></span>
                <p>Formação<br />(50% informações opcionais)</p>

            <div class="clear"></div>

            <div class="infos-messenge">
                <a href="#" class="close">X</a>
                Algumas informações já foram preenchidas de acordo com o cadastro que o MinC possui de seu Ponto. Configra com atenção essas informações antes de validá-las!
            </div>
        */ ?>
            <button class="btn-validar" ng-class="" ng-disabled="!termos_de_uso" ng-click="enviar()"> Enviar </button>



      </article>

    </section>
</div>
