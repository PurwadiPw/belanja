
            <div class="row text-center">
                <?php foreach($this->produkList() as $produk): ?>
                <div class="col-md-3 col-sm-6 home-feature">
                    <div class="thumbnail">
                        <img src="<?= base_url ?>/assets/img/<?= $produk->product_img_name ?>" alt="<?= $produk->product_name ?>">
                        <div class="caption">
                            <h3><?= $produk->product_name ?> </h3>
                            <p>Harga: Rp. <?= $this->rupiah($produk->price) ?>,- </p>
                            <form action="<?= base_url ?>/?page=cart" method="post">
                                <input type="hidden" name="produk_id" value="<?= $produk->id ?>">
                                <input type="hidden" name="produk_stok" value="<?= $produk->stock ?>">
                                <input type="hidden" name="produk_harga" value="<?= $produk->price ?>">
                                <p><button type="submit" class="btn btn-primary btn-block" name="proses" value="Beli">Beli</button></p>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>