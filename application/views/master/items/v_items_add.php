<section class="content-header">
	<h1>Items <small>Add Items</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('Dashboard') ?>">
				<i class="fa fa-dashboard"></i>
			</a>
		</li>
		<li>
			Master
		</li>
		<li>
			<a href="<?= site_url('items') ?>">
				Items
			</a>
		</li>
		<li class="active">
			Add
		</li>

	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h4>
				Add Items
				<div class="pull-right">
					<a href="<?= site_url('items') ?>" class="btn btn-warning">
						<i class="fa fa-arrow-right"></i>
					</a>
				</div>
			</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="" method="POST">
						<label for="">ID Items <i class="text-danger">*</i></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="text" name="items_key" id="items_key" class="form-control" placeholder="ID Items" value="P_<?= sprintf("%04s", $row) ?>" readonly>
						</div>
						<?= form_error('items_key', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<label for="name_items">Nama Items <i class="text-danger">*</i></label>
						<div class="input-group <?= form_error('name_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
							<input type="text" id="name_items" name="name_items" class="form-control" value="<?= set_value('name_items') ?>" placeholder="Nama Items" autofocus autocomplete="off">
						</div>
						<?= form_error('name_items', '<div class="text-danger">', '</div>'); ?>
						<br>
						<div class="form-group">
							<label for="categories_id">Kategori <i class="text-danger">*</i></label>
							<select name="categories_id" id="categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<?php foreach ($categories as $key => $data) { ?>
									<option value="<?= $data->categories_id ?>" <?= set_value('categories_id') == $data->categories_id ? "selected" : null ?>><?= $data->name_categories ?></option>
								<?php } ?>
							</select>
							<?= form_error('categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<!--  -->
						<div class="form-group">
							<label for="sub_categories_id">Sub Kategori <i class="text-danger">*</i></label>
							<select name="sub_categories_id" id="sub_categories_id" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
							</select>
							<?= form_error('sub_categories_id', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div>
							<label for="harga_items">Harga <i class="text-danger">*</i></label>
						</div>
						<div class="input-group  <?= form_error('harga_items') == true ? 'has-error' : null ?>">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<input type="text" id="harga_items" onkeyup="splitInDots(this)" name="harga_items" class="form-control" placeholder="Harga Items" value="<?= set_value('harga_items') ?>" autocomplete="off">
						</div>
						<?= form_error('harga_items', '<div class="text-danger">', '</div>'); ?>
						<!--  -->
						<br>
						<div class="form-group">
							<label for="type_qty">Satuan <i class="text-danger">*</i></label>
							<select name="type_qty" id="type_qty" class="form-control select2" style="width: 100%;">
								<option value="">-- Pilih --</option>
								<option value="Kg">Kg</option>
								<option value="pcs">pcs</option>
							</select>
							<?= form_error('type_qty', '<div class="text-danger">', '</div>'); ?>
						</div>
						<div style="display: none;" id="qty_items_show">
							<label for="qty_items">pcs <i class="text-danger">*</i></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dropbox"></i></span>
								<input type="text" id="qty_items" onkeyup="splitInDots(this)" name="qty_items" class="form-control" placeholder="pcs" autocomplete="off">
							</div>
						</div>
						<div style="display: none;" id="qty_items_kg_show">
							<label for="qty_items_kg">Kg <i class="text-danger">*</i></label>
							<div class="input-group ">
								<span class="input-group-addon"><i class="fa fa-cubes"></i></span>
								<input type="text" id="qty_items_kg" name="qty_items_kg" class="form-control" placeholder="Kg" autocomplete="off">
							</div>
							<small class="text-danger">* Perhatikan ( . ) padaa saat input Kg</small>
						</div>
						<br>
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
	$(document).ready(function() {
		$('#categories_id').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?= base_url('items/get_subkategori') ?>",
				method: "POST",
				data: {
					id: id
				},
				async: false,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value="' + data[i].sub_categories_id + '">' + data[i].name_sub_categories + '</option>';
					}
					$('#sub_categories_id').html(html);

				}
			});
		});



	});
</script>

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

<script>
	$(document).ready(function() {

		$('#type_qty').on('change', function() {
			if (this.value == 'Kg') {
				$("#qty_items_kg_show").show();
				$("#qty_items_show").hide();
			} else if (this.value == 'pcs') {
				$("#qty_items_kg_show").hide();
				$("#qty_items_show").show();
			} else {
				$("#qty_items_kg_show").hide();
				$("#qty_items_show").hide();
			}
		});

	});
</script>
