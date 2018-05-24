
        <div class="container" id="content">
		        <div class="row">
		            <div class="col-md-12">
		                <?php if($pesan): ?>
		                <div class="alert alert-info">
		                  <?= $pesan ?>
		                </div>
		                <?php endif; ?>
		            </div>
		        </div>
						
						<?php if($this->cartList() != null): ?>
						<table class="table table-bordered table-stripped table-hover table-cart">
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Sub Total</th>
								<th colspan="2">Aksi</th>
							</tr>
							<?php $no=1; ?>
							<?php foreach($this->cartList() as $cart): ?>
							<tr>
								<form action="" method="post">
									<td><?= $no; ?></td>
									<td><img src="<?= base_url ?>/assets/img/<?= $cart->product_img_name ?>" width="100"></td>
									<td class="text-left"><?= $cart->product_name ?></td>
									<td><input type="text" name="quantity" value="<?= $cart->quantity ?>" size="1" maxlength="3"></td>
									<td class="text-right">Rp. <?= $this->rupiah($cart->price) ?>,-</td>
									<td class="text-right">Rp. <?= $this->rupiah($cart->harga) ?>,-</td>
									<td>
										<input type="hidden" name="jual_id" value="<?= $cart->jual_id ?>">
										<input type="hidden" name="produk_stok" value="<?= $cart->stock ?>">
										<input type="hidden" name="produk_harga" value="<?= $cart->price ?>">
										<button type="submit" name="update" class="btn btn-sm btn-primary btn-block">Update</button>
									</td>
									<td>
										<button type="submit" name="hapus" class="btn btn-sm btn-primary btn-block">Hapus</button>
									</td>
								</form>
							</tr>
							<?php $total += $cart->harga; ?>
							<?php $no++; ?>
							<?php endforeach; ?>
							<tr>
								<td colspan="5"></td>
								<td class="text-right">Rp. <?= $this->rupiah($total) ?>,-</td>
								<td colspan="2">
									<a href="<?= base_url ?>/?page=checkout" class="btn btn-sm btn-primary btn-block">Checkout</a>
								</td>
							</tr>
						</table>
						<?php else: ?>
		        <div class="row">
		            <div class="col-md-12">
		                <div class="alert alert-info">Maaf, Keranjang Belanja Anda Masih Kosong</div>
		            </div>
		        </div>
						<?php endif; ?>
						<hr>
        </div>