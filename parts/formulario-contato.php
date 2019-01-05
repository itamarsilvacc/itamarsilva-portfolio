<form action="<?php echo SITE_URL; ?>/#contatos" method="post" class="row">
	<div class="col-md-12">
		<?php
			global $erro_contato;
			if ( $erro_contato ) { ?>
			<p class="msg-form"><big>
				<?php echo $erro_contato; ?>
			</big></p>
		<?php } ?>
	</div>
	<input type="hidden" name="contato" value="1">
	<div class="col-md-6">
		<div class="form-group">
			<input class="form-control" type="text" name="nome" placeholder="Nome">
		</div>
		<div class="form-group">
			<input class="form-control" type="email" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input class="form-control" type="text" name="assunto" placeholder="Assunto">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<textarea class="form-control" name="mensagem" placeholder="Mensagem"></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Enviar</button>
		</div>							
	</div>
</form>