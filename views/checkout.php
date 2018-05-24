
        <div class="container" id="content">
        		<div class="row">
        			<div class="col-md-8">
        				<div class="title-col">Daftar Belanja</div>
								<?php if($this->cartList() != null): ?>
								<table class="table table-bordered table-stripped table-hover table-cart">
									<tr>
										<th>No</th>
										<th>Produk</th>
										<th>Jumlah</th>
										<th>Harga</th>
										<th>Sub Total</th>
									</tr>
									<?php $no=1; ?>
									<?php $total=0; ?>
									<?php foreach($this->cartList() as $cart): ?>
									<tr>
										<form action="" method="post">
											<td><?= $no; ?></td>
											<td class="text-left"><?= $cart->product_name ?></td>
											<td><?= $cart->quantity ?></td>
											<td class="text-right">Rp. <?= $this->rupiah($cart->price) ?>,-</td>
											<td class="text-right">Rp. <?= $this->rupiah($cart->harga) ?>,-</td>
										</form>
									</tr>
									<?php $total += $cart->harga; ?>
									<?php $no++; ?>
									<?php endforeach; ?>
									<tr>
										<td colspan="4"></td>
										<td class="text-right">Rp. <?= $this->rupiah($total) ?>,-</td>
									</tr>
								</table>
								<?php else: ?>
				        <div class="row">
				            <div class="col-md-12">
				                <div class="alert alert-info">Maaf, Keranjang Belanja Anda Masih Kosong</div>
				            </div>
				        </div>
								<?php endif; ?>
        			</div>
        			<div class="col-md-4">
								<div class="title-col">Data Checkout #<?= $no_penjualan ?></div>
        				<div class="form-checkout">
									<h3>Informasi Pengiriman</h3>
									<div class="form-checkout-table">
										<form action="" method="post">
											<table>
												<tr>
													<td>Nama<br>
														<input type="hidden" name="no_penjualan" value="<?= $no_penjualan ?>">
														<input type="hidden" name="user_id" value="<?= $user->user_id ?>">
														<input type="text" name="user_nama" value="<?= $user->user_nama ?>" class="select_checkout" required>
													</td>
												</tr>
												<tr>
													<td>No. Hp<br>
														<input type="text" name="user_telp" value="<?= $user->user_telp ?>" class="select_checkout" required>
													</td>
												</tr>
												<tr>
													<td>Alamat<br>
														<textarea name="user_alamat" required><?= $user->user_alamat ?></textarea>
													</td>
												</tr>
												<tr>
													<td><input type="submit" name="submit_selesai" value="Selesai" class="btn btn-primary btn-block"></td>
												</tr>
											</table>
										</form>
									</div>
        				</div>
        			</div>
        		</div>
        		<hr>
						<?php require_once 'produk_list.php'; ?>
        </div>