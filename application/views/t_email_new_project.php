<section>
    <div>
	<?php foreach($data as $data_email){ ?>
		<p>
		<?php echo $description; ?>
		</p>
	<?php } ?> 
    </div>
    
    <footer>
    <br>
    Regards,
    <br>
    <?php echo $this->session->userdata('USERNAME') ;  ?>
    </footer>
</section>



