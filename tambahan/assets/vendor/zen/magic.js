halaman_pertama = 'awal/beranda'
bagian_komponen = '.isi'

lokasi = () => {
	!location.hash ? location.href = `/#/${halaman_pertama}` : ''
	komponen = location.hash.split('#/')[1]
	$(bagian_komponen).load(`/${komponen}`)
}
lokasi()
$(window).on('hashchange', () => {
	lokasi()
})
