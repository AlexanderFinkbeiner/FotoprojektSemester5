<section class="jumbotron text-xs-center">
	<section class="text-xs-left">
		<div class="container">
			<?php
			echo form_open ( 'Newsletter/' );
			?>
			<div class="">
				<h2>Newsletteranmeldung:</h2>
				<br> 
				<input type="text" class="form-control input-sm chat-input" placeholder="Vor- und Nachname*" name="name"/>
				<br />
				<input type="text" class="form-control input-sm chat-input" placeholder="E-Mail Adresse*" name="email"/>
				<br />
				<div class="form-group">
			   
			  </div>
				
				<div id="fehler_span" class="text-danger"><?php
				
				echo $this->session->flashdata ( 'newsletterMsg' );
				?></div>
				<span class="group-btn">    
		            	<button name="submit" type="submit" class="btn btn-primary btn-md">Anmelden</button>
		        </span>
			</div>
		</div>

	</section>
</section>