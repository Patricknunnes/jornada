<div class="container-fluid">
	<div class="row no-gutter" style="justify-content: center;">
		<div class="d-none d-md-flex col-md-4 col-lg-5 bg-image" id="imagem">
			<div class="row  no-gutter">
				<div class="col-md-12 col-lg-12" style="margin-top:20px">
					<!-- <h1 style="color:#32549b;text-align:justify" class="align-items-center">Descobrindo um mundo incrível com as pesquisas</h1> -->
					<p>
						<img class=" p-5 fixed-top img-fluid h-100 d-inline-block" src="<?= base_url() ?>/assets/img/ilustracao-bem-vindo.png" style="width: 42%!important;"/>
					</p>
				</div>
			</div>

		</div>
		<div class="col-md-8 col-lg-7">
			<div class="login d-flex align-items-center ">
				<div class="container">
					<div class="row">
						<p id="poppins_title" style="margin-top: 20px; color: #424f8b!important; text-align: center; font-weight: bold!important; font-size: 18px;">Informamos que o TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO abaixo será apresentado ao participante antes de ser direcionado aos questionários online do estudo.</p>

						<p class="texto-p" id="poppins_text">
							Você está convidado (a) a participar de uma pesquisa realizada pelo Instituto D’Or de Pesquisa e Ensino (IDOR). Primeiro, gostaríamos de esclarecer que esta participação é inteiramente voluntária, isto é, você pode optar por não participar ou se retirar a qualquer momento do estudo.
						</p>
						<br>

						<p class="texto-titulo" id="poppins_title">
							Justificativa do estudo
						</p>
						<br>

						<p class="texto-p" id="poppins_text">
							O contexto da pandemia aumentou de uma forma significativa o estresse na população geral. O nosso projeto vai contribuir para o melhor entendimento de fatores de proteção e risco para estresse e a relação de variáveis individuais com o bem-estar.
						</p>
						<br>

						<p class="texto-titulo" id="poppins_title">
							Objetivo do estudo
						</p>
						<br>

						<p class="texto-p" id="poppins_text">
							Essa pesquisa tem o objetivo de verificar a relação de diferentes instrumentos de auto-relato medindo valores, personalidade, relacionamento e crenças com bem-estar.
						</p>
						<br>

						<p class="texto-titulo" id="poppins_title">
							Benefícios
						</p>
						<br>

						<p class="texto-p" id="poppins_text">
							Como benefício direto você poderá ver o resultado das suas respostas para os questionários preenchidos em uma linguagem acessível sobre conceitos relacionados à personalidade, valores, e outros construtos. Essas informações são apenas didáticas, não possuem valor diagnóstico, nem representam critérios de avaliação de performance. Ainda, como benefício indireto, a sua participação certamente ajudará o avanço do conhecimento de “perfis psicológicos” relacionados com bem-estar, que poderá auxiliar na implementação de intervenções futuras mais focadas.
						</p>
						<br>

						<p class="texto-titulo" id="poppins_title">
							Riscos
						</p>
						<br>

						<p class="texto-p" id="poppins_text">
							Os riscos serão mínimos, você apenas responderá aos questionários online e pode deixar em branco qualquer pergunta que não quiser responder. Os seus contatos (e-mail e telefone) estarão disponíveis somente para os pesquisadores envolvidos no estudo. Serão mantidos de acordo com as principais diretrizes de segurança digital, havendo baixo risco de quebra de confidencialidade e utilizado apenas para enviar questionários futuros ou convidar você a participar de projetos relacionados.
						</p>

						<p class="texto-titulo" id="poppins_title">
							A sua participação envolverá:<br>
						</p>

						<p class="texto-p" id="poppins_text" style="margin-bottom: 0!important; margin-top: 2px;">
							(1) leitura e anuência deste documento com consentimento;
						</p>
						<p class="texto-p" id="poppins_text">
							(2) preenchimento de questionários sobre você, sua personalidade, valores e crenças;
						</p>

						<p class="texto-p" id="poppins_text">
							A equipe pode ser contatada a qualquer momento para tirar qualquer dúvida ou para obter atualização sobre os resultados parciais da pesquisa tel. (21) 3883-6000, e-mail ronald.fischer@idor.org. Se você tiver alguma consideração ou dúvida sobre a ética da pesquisa, entre em contato com o Comitê de Ética em Pesquisa (CEP) que a aprovou.: CEP Instituto D’Or de Pesquisa e Ensino, e-mail cep.idor@idor.org tel. (21) 3883-6013, endereço: Rua Diniz Cordeiro, 30, 2o andar, Sala do Comitê de Ética em Pesquisa – Botafogo – Rio de Janeiro – CEP 22281-100. É importante você salvar uma cópia desse documento eletrônico se tiver dúvidas futuras.
						</p>

						<p class="texto-p" id="poppins_text">
							As informações coletadas durante a sua participação serão analisadas em conjunto com as informações dos outros voluntários. O seu consentimento permite o uso dos dados coletados apenas para pesquisa científica e educação. Todos os dados relativos à sua participação serão mantidos em local reservado e seguro, todos os dados coletados serão confidenciais e mantidos em sigilo. Os dados poderão ser discutidos com pesquisadores de outras instituições e publicados em revistas científicas, ou fazerem parte de material educacional. Nenhuma informação privada, ou que possa levar à identificação dos participantes, será fornecida a terceiros.<br>
						</p>
						<p class="texto-titulo" id="poppins_title">
							Consentimento para participar deste estudo:
						</p>
						<p class="texto-p" id="poppins_text">
							Se você possui mais de 18 anos e acredita ter sido suficientemente informado (a) a respeito do estudo acima citado e concorda voluntariamente em participar do mesmo, por favor marque a opção mais adequada abaixo:<br>
						</p>

						<form action="<?= base_url('') ?>index.php/termos/store" method="POST">
							<div class="form-check" id="poppins_text">
								<input class="form-check-input" value="sc" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
								<label class="form-check-label" for="flexRadioDefault">
									<p style="font-size: 19px;">
										<strong>Sim</strong>, aceito participar e ser contatado (a) para estudos futuros semelhantes.
									</p>
								</label>
							</div>
							<div class="form-check" id="poppins_text">
								<input class="form-check-input" value="sn" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
								<label class="form-check-label" for="flexRadioDefault">
									<p style="font-size: 19px;">
										<strong>Sim</strong>, aceito participar e não quero ser contatado no futuro.
									</p>
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" value="n" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
								<label class="form-check-label" for="flexRadioDefault">
									<p id="poppins_text" style="font-size: 19px;">
										Não aceito participar.
									</p>
								</label>
							</div>

							<button type="submit" class="btn mb-3" id="exo_subtitle" style="padding: 10px 43px; min-height: 40px; background: #2C234D; border-radius: 30px; color: #fff;">
								Continuar
							</button>
							<br>
							<br>
							<br>
							<div class="container-fluid">
								<p style="text-align: center; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: #2F4F4F; margin-top: 20px;">Curadoria de Conteúdo: IDOR Saúde Mental - 2021</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.texto-titulo {
		font-size: 16px;
		text-align: justify;
		margin-bottom: 0;
		font-weight: 600;
		text-decoration: underline;
		padding-bottom: 2px
	}

	.texto-p {
		font-size: 15px;
		text-align: justify;
		text-indent: 2.5em;
	}

	@media (max-width:1024px) {
		#imagem {
			display: none !important;
		}
	}
</style>