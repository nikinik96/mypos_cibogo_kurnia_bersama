<?php
date_default_timezone_set("Asia/Bangkok");
?>

<section class="content-header">
	<h1>Data Dashboard <small>Dashboard</small></h1>
	<ol class="breadcrumb">
		<li class="active">
			<i class="fa fa-dashboard"></i>
		</li>
	</ol>
</section>


<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h2>Welcome Back, <?= ucfirst($this->fungsi->user_login()->nama); ?></h2>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-lg-6 col-xs-6">
					<div class="small-box bg-green">
						<div class="inner">
							<h3>
								<?php foreach ($pendapatan as $row => $data) { ?>
									<?php foreach ($pendapatan_dp as $row => $pendapatan_dp) { ?>
										<?= indo_currency($data->sum_pendapatan_m + $pendapatan_dp->sum_dp) ?>
									<?php } ?>
								<?php } ?>
							</h3>
							<p>Pendapatan Bulan : <b><?= date('F') ?></b> </p>
						</div>
						<div class="icon">
							<span>Rp</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xs-6">
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?= indo_qty($customer) ?></h3>

							<p>Jumlah Customer</p>
						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
