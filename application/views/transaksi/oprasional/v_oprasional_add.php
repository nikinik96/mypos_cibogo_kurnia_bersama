<section class="content-header">
	<h1>Add Biaya Pengurusan <small>Biaya Pengurusan</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Transaksi
		</li>
		<li>
			<a href="<?= site_url('oprasional') ?>">
				Biaya Pengurusan
			</a>
		</li>
		<li class="active">
			add
		</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h4>Add Biaya Pengurusan
				<div class="pull-right">
					<a href="<?= site_url('oprasional') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="<?= site_url('oprasional/add') ?>" method="POST">
						<div class="form-group">
							<label for="">Tanggal <i class="text-danger">*</i></label>
							<input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>">
						</div>
						<label for="">ID Biaya Pengurusan <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="bp_key" id="bp_key" class="form-control" placeholder="ID Bp" value="BP_<?= sprintf("%04s", $row) ?>" readonly>
						</div>
						<?= form_error('bp_key', '<div class="text-danger">', '</div>'); ?>
						<br>
						<div class="form-group">
							<label for="pt_customers">Perusahaan <i class="text-danger">*</i></label>
							<div class="input-group <?= form_error('pt_customers') == TRUE ? 'has-error' : null ?>">
								<span class="input-group-addon"><i class="fa fa-building"></i></span>
								<input type="text" name="pt_customers" id="pt_customers" class="form-control" placeholder="Perusahaan" value="<?= set_value('pt_customers') ?>" autocomplete="off" autofocus="true">
							</div>
							<?= form_error('pt_customers', '<div class="text-danger">', '</div>'); ?>
						</div>
						<label for="fee">Fee <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('fee_oprasional') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="fee_oprasional" name="fee_oprasional" class="form-control" placeholder="Fee" value="<?= set_value('fee_oprasional') ?>" autocomplete="off">
						</div>
						<?= form_error('fee_oprasional', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="oprasional">Oprasional <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('oprasional') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="oprasional" name="oprasional" class="form-control" placeholder="Oprasional" value="<?= set_value('oprasional') ?>" autocomplete="off">
						</div>
						<?= form_error('oprasional', '<div class="text-danger">', '</div>'); ?>
						<br>
						<!--  -->
						<label for="pajak_tax">Pajak/tax <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('pajak_tax') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="pajak_tax" name="pajak_tax" class="form-control" placeholder="Pajak/tax" value="<?= set_value('pajak_tax') ?>" autocomplete="off">
						</div>
						<?= form_error('pajak_tax', '<div class="text-danger">', '</div>'); ?>
						<br>
						<label for="lab">Ls/Lab <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('lab') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="lab" name="lab" class="form-control" placeholder="Ls/Lab" value="<?= set_value('lab') ?>" autocomplete="off">
						</div>
						<?= form_error('lab', '<div class="text-danger">', '</div>'); ?>
						<br>
						<label for="jasa_perushaan">Jasa Perusahaan <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('jasa_perushaan') == TRUE ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" onkeyup="splitInDots(this)" id="jasa_perushaan" name="jasa_perushaan" class="form-control" placeholder="Jasa Perusahaan" value="<?= set_value('jasa_perushaan') ?>" autocomplete="off">
						</div>
						<?= form_error('jasa_perushaan', '<div class="text-danger">', '</div>'); ?>
						<br>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	function reverseNumber(input) {
		return [].map.call(input, function(x) {
			return x;
		}).reverse().join('');
	}

	function plainNumber(number) {
		return number.split('.').join('');
	}

	function splitInDots(input) {
		var value = input.value,
			plain = plainNumber(value),
			reversed = reverseNumber(plain),
			reversedWithDots = reversed.match(/.{1,3}/g).join('.'),
			normal = reverseNumber(reversedWithDots);
		input.value = normal;
	}
</script>
