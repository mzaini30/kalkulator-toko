<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="reset.css" />
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<div class="app">
		<div class="header">Kalkulator Toko</div>

		<div class="container-harga">
			<div class="wadah-harga" v-for='(x, n) in harga'>
				<input type="text" placeholder="nama barang" v-model='x.nama_barang' class="nama-barang" />
				<div class="duit">
					<input type="tel" @keyup='cek(n)' placeholder="harga" v-model='x.harga' />
					<input type="tel" placeholder="banyak" v-model='x.banyak' />
					<input type="tel" placeholder="total" readonly v-model='(x.harga * (x.banyak ? x.banyak : 1)).toLocaleString("id")' />
				</div>
			</div>
		</div>

		<div class="wadah-total">
			<div class="total">{{ (harga.map(x => {
				return x.harga * (x.banyak ? x.banyak : 1)
			}).reduce((a, b) => a + b)).toLocaleString("id") }}</div>
		</div>
	</div>
	<script src="vue.js"></script>
	<script>
		PetiteVue.createApp({
			harga: [
				{nama_barang: '', harga: '', banyak: ''},
			],
			cek(n){
				const posisi = +n + 1
				if (posisi == this.harga.length){
					this.harga = [...this.harga, {nama_barang: '', harga: '', banyak: ''}]
				}
			}
		}).mount('.app')
	</script>
</body>
</html>