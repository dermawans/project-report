<section>
    <header>
        Dear All,
        <br>
        Berikut di informasikan report project hari ini (<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d, H:i:s") ;  ?>)
    </header>
    
    <div>
        <div>
        <table border="1"> 
                <tr>
                    <td>No</td>
                    <td>Project Name</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Project Status</td>	
                    <td>Timeline Status</td>	
                    <td>Priority</td>	
                    <td>PMO</td>
                    <td>QT</td> 
                    <td>Description</td>
                </tr> 
            <?php 
				$no=1;
				if(isset($data_project)){
					foreach($data_project as $row){ 
			?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->projectname; ?></td>
					<td><?php echo date("d M Y",strtotime($row->st_awal)); ?></td>
					<td><?php echo date("d M Y",strtotime($row->st_akhir)); ?></td>
					<td><?php echo $row->status_project; ?></td>
					<td>
						<?php
						$akhir=strtotime($row->st_akhir);
						$sekarang= time();
						$sisa = $akhir-$sekarang;
						$sisahari= floor($sisa / (60 * 60 * 24)+1)." days left";
						if ($sisahari>0)
						{ echo $sisahari; }
						else if ($sisahari==0)
						{ echo "Expired Today"; }
						else
						{ echo "Expired"; }
						?>
					</td>
					<td><?php echo $row->priority; ?></td>
					<td><?php echo $row->pmoname; ?></td>
					<td><?php echo $row->qtname; ?></td>
					<td><?php echo $row->description; ?></td>
				</tr>
			  <?php }
				}
			  ?>
 
        </table>
        </div>
    </div>
    
    <footer>
    Demikian report project saya.
    <br>
    Regards,
    <br>
    <?php echo $this->session->userdata('USERNAME') ;  ?>
    </footer>
</section>



