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
	<div class="app" v-cloak @vue:mounted='init'>
		<div class="header">Kalkulator Toko</div>

		<div class="container-harga">
			<div class="wadah-harga" v-for='(x, n) in harga'>
				<input type="text" placeholder="nama barang" @keyup='simpan' v-model='x.nama_barang' class="nama-barang" />
				<div class="duit">
					<input type="tel" @keyup='cek(n)' placeholder="harga" v-model='x.harga' />
					<input type="tel" placeholder="1" @keyup='simpan' v-model='x.banyak' />
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
	<script src="vue.min.js"></script>
	<script src="idb-keyval.min.js"></script>
	<script>
		const {set, get} = idbKeyval
		const {createApp} = PetiteVue

		function json(x){
			return JSON.parse(JSON.stringify(x))
		}

		createApp({
			harga: [
				{nama_barang: '', harga: '', banyak: ''},
			],
			async init(){
				const data = await get('data')
				if (data){
					this.harga = data
				}
			},
			simpan(){
				set('data', json(this.harga))
			},
			cek(n){
				this.simpan()
				const posisi = +n + 1
				if (posisi == this.harga.length){
					this.harga = [...this.harga, {nama_barang: '', harga: '', banyak: ''}]
				}
			}
		}).mount('.app')
	</script>
</body>
</html>