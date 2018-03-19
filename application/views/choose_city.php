<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>按照省份选择</h3>
			<hr>
		</div>

		<div class="col-md-8 col-md-offset-2 lf-province-container">
			<?php foreach ($province as $i=>$p):?>
			<div class="lf-province">
				<span class="lf-pro"><?php echo $p['area_name'];?></span>
				<ul class="lf-city">
					<?php foreach ($p['city'] as $ci=>$c):?>
						<li><a href="<?php echo site_url('Area/city').'?id='.$c['area_id'];?>"><?php echo $c['area_name'];?></a></li>
					<?php endforeach?>
				</ul>
			</div>
			<?php endforeach?>
			
		</div>
	</div>
</div>