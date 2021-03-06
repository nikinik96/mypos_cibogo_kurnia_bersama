<section class="content-header">
	<h1>Add Cash In
		<small>Cash In</small>
	</h1>
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
			Cash In
		</li>
		<li class="active">
			Add
		</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>Add Cash In
				<div class="pull-right">
					<a href="<?= site_url('cash_in_and_out') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="<?= site_url('cash_in_and_out/proses') ?>" method="POST">
						<div class="form-group">
							<label for="date">Tanggal <i class="text-danger">*</i></label>
							<input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
						</div>
						<div class="form-group">
							<label for="type_in">Type <i class="text-danger">*</i></label>
							<input type="text" name="type_in" id="type_in" class="form-control" value="In" readonly required>
						</div>
						<div class="form-group">
							<label for="nama">Nama <i class="text-danger">*</i></label>
							<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" autocomplete="off" autofocus required>
						</div>
						<div class="form-group">
							<label for="payment">Payment <i class="text-danger">*</i></label>
							<select id="payment_in" name="payment_in" class="form-control select2" style="width: 100%;" required>
								<option value=""> --Pilih-- </option>
								<option value="1">Cash</option>
								<option value="2">Debit</option>
							</select>
						</div>
						<div class="form-group">
							<label for="total_in">Total <i class="text-danger">*</i></label>
							<input type="text" onkeyup="splitInDots(this)" name="total_in" id="total_in" class="form-control" placeholder="Total In" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="noted">Keterangan<i class="text-danger">*</i></label>
							<textarea name="noted" id="noted" cols="30" rows="4" class="form-control" placeholder="Keterangan" required></textarea>
						</div>
						<div class="form-group">
							<button type="reset" class="btn btn-danger"><i class="fa fa-rotate-left"></i></button>
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
