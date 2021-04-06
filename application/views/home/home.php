      <section style="background: url('<?= base_url('assets/front_end/') ?>img/photogrid.jpg') center center repeat; background-size: cover;" class="relative-positioned">

        <div class="home-carousel">
          <div class="dark-mask mask-primary"></div>
          <div class="container">
            <div class="homepage owl-carousel">
              <div class="item">
             
        </div>

      </section>
      <section class="bar no-mb">
        <div class="container">
          <div class="col-md-12">
            <div class="heading text-center">
              <h2>Produk</h2>
            </div>
            <div class="row text-center">
              <?php
                $sql    = "SELECT * FROM abe_produk WHERE status = 'lelang' ORDER BY rand() LIMIT 8";
                $produk = $this->db->query($sql)->result();
                foreach ($produk as $row) {
                  $id_kategori  = $row->id_kategori;
                  $id_produk    = $row->id_produk;
                  $kategori = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                  $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
              ?>
                <div class="col-md-3">
                  <div data-animate="fadeInUp" class="team-member">
                    <div class="image">
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>">
                      <img width="200" height="200" class="img-circle" src="<?= base_url('assets/foto_produk/').$foto['file_foto'] ?>" ></a>
                    </div>
                    <h3><a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a></h3>
                    <p class="role"><?= $kategori['nama_kategori'] ?></p>
                    <div class="text">
                      <p><strong> Rp. <?= number_format($row->harga_produk,2,',','.') ?> </strong></p>
                    </div>
                    <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-template-main">Bid Now..!!</a>
                    
                  </div>
                </div>

              <?php
                 } 
              ?>

            </div>
          </div>
        </div>

        <?php
          if($this->session->userdata('id') == ''){
            echo "";
          }else{
        ?>
          <div class="container">
            <div class="col-md-12">
              <div class="heading text-center">
                <h2>Mungkin Kamu Suka</h2>
              </div>
              <div class="row text-center">
                <?php
                  $user   = $this->session->userdata('id');
                  $query  = $this->db->query("SELECT MAX(jumlah_klik) as max_klik, id_kategori FROM abe_kategori_klik WHERE id_bidder = '$user'")->row_array(); 
                  $kategori_klik = $query['id_kategori']; 

                  $sql    = "SELECT * FROM abe_produk WHERE status = 'lelang' AND id_kategori = '$kategori_klik' ORDER BY rand() LIMIT 8 ";
                  $produk = $this->db->query($sql)->result();
                  foreach ($produk as $row) {
                    $id_kategori  = $row->id_kategori;
                    $id_produk    = $row->id_produk;
                    $kategori = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                    $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                    $bidder = $this->db->query("SELECT * FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->num_rows();
                ?>
                  <div class="col-md-3">
                    <div data-animate="fadeInUp" class="team-member">
                      <div class="image">
                        <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>">
                        <img width="200" height="200" class="img-circle" src="<?= base_url('assets/foto_produk/').$foto['file_foto'] ?>" ></a>
                      </div>
                      <h3><a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a></h3>
                      <p class="role"><?= $kategori['nama_kategori'] ?></p>
                      <div class="text">
                        <p><strong> Rp. <?= number_format($row->harga_produk,2,',','.') ?> </strong></p>
                      </div>
                      <div class="ribbon-holder">
                        <div class="ribbon new"><?= $bidder ?> lelang</div>
                      </div>
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-template-main">Lelang</a>
                      
                    </div>
                  </div>
                <?php
                   } 
                ?>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="col-md-12">
              <div class="heading text-center">
                <h2>Rekomendasi Bid</h2>
              </div>
              <div class="row text-center">
                <?php
                  $user   = $this->session->userdata('id');
                  $query2  = $this->db->query("SELECT id_kategori, count(id_kategori) AS jumlah FROM abe_lelang_bidder WHERE id_bidder = '$user' group by id_kategori ORDER BY jumlah DESC limit 1")->row_array(); 
                  $kategori_bid = $query2['id_kategori']; 

                  $sql2    = "SELECT * FROM abe_produk WHERE status = 'lelang' AND id_kategori = '$kategori_bid' ORDER BY rand() LIMIT 8 ";
                  $produk2 = $this->db->query($sql2)->result();
                  foreach ($produk2 as $row) {
                    $id_kategori  = $row->id_kategori;
                    $id_produk    = $row->id_produk;
                    $kategori = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                    $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                    $bidder = $this->db->query("SELECT * FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->num_rows();
                ?>
                  <div class="col-md-3">
                    <div data-animate="fadeInUp" class="team-member">
                      <div class="image">
                        <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>">
                        <img width="200" height="200" class="img-circle" src="<?= base_url('assets/foto_produk/').$foto['file_foto'] ?>" ></a>
                      </div>
                      <h3><a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a></h3>
                      <p class="role"><?= $kategori['nama_kategori'] ?></p>
                      <div class="text">
                        <p><strong> Rp. <?= number_format($row->harga_produk,2,',','.') ?> </strong></p>
                      </div>
                      <div class="ribbon-holder">
                        <div class="ribbon new"><?= $bidder ?> bid</div>
                      </div>
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-template-main">Bid Now..!!</a>
                      
                    </div>
                  </div>
                <?php
                   } 
                ?>
              </div>
            </div>
          </div>
        <?php
          }
        ?>


      </section>
      <section class="bar no-mb">
        <div data-animate="fadeInUp" class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="heading text-center">
                <h3>Kategori Terbaru</h3>
              </div>
              <div class="row portfolio text-center no-space">
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Painting Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/painting') ?>" class="color-white">Berwarna</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block">  gambar yang bervariasi warna</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/painting') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Wooden Craft Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/woodencraft') ?>" class="color-white">Kerajinan Kayu</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block">kerajinan kayu yang sangat bagus</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/woodencraft') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Mixed Media Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/mixedmedia') ?>" class="color-white">Media Campuran</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block"> Kerajinan dengan media Campuran</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/mixedmedia') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Wooden Cut Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/woodcut') ?>" class="color-white">
Ukiran kayu</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block">Sebuah kerajinan dengan cara Ukiran</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/woodcut') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Fine Art Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/fineart') ?>" class="color-white">
Seni Rupa
</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block"> Seni yang dibuat oleh manusia</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/fineart') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="box-image">
                    <div class="image"><img src="<?= base_url('assets/front_end/') ?>img/Sculpture Logo.png" alt="" class="img-fluid">
                      <div class="overlay d-flex align-items-center justify-content-center">
                        <div class="content">
                          <div class="name">
                            <h3><a href="<?= base_url('home/kategori/sculpture') ?>" class="color-white">Patung</a></h3>
                          </div>
                          <div class="text">
                            <p class="d-none d-sm-block">kerjajinan  patung untuk koleksi</p>
                            <p class="buttons"><a href="<?= base_url('home/kategori/sculpture') ?>" class="btn btn-template-outlined-white">View</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>