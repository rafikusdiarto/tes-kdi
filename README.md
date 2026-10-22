## Portal Supplier
- Fitur utama dibagi menjadi 2 :
  - Fitur portal untuk supplier submit data penawaran
  - Fitur backpanel untuk tim procurement melihat data penawaran yang sudah di submit

### Fitur Portal
- Supplier mengakses halaman melalui QR berikut yang mengarah ke portal
![alt text](<qr portal.png>)
- Supplier mengisikan data, mulai data perusahaan, data pribadi, dan data produk yang akan ditawarkan
- Supplier baru bisa mengisikan data perusahaan terlebih dahulu di portal, jika sudah pernah melakukan penawaran bisa langsung dicari nama perusahaan supplier
- Supplier bisa menambahkan produk yang tidak ada dalam list
- Supplier wajib mengisikan detail barang yang ditawarkan seperti, satuan, kuantitas, dan harga

### Fitur Backpanel Tim Procurement
- Untuk mengakses backpanel, diwajibkan untuk melakukan login terlebih dahulu
- Pada backpanel dibagi menjadi 2 Menu
  - Master Data : master data satuan (uom), master data produk, master data supplier
  - Transaction : List Penawaran Supplier
#### Master Data
- Pada menu master data tim bisa menambahkan initial satuan yang biasa dipakai
- Untuk menu produk bisa menambahkan produk beserta satuannya
- Menu supplier untuk melihat data supplier atau juga bisa menambahkan supplier dari supplier
#### Transaction
- Pada menu transaction ini tim bisa melihat serta melakukan action edit pada data penawaran yang sudah tersubmit
- Data penawaran terdapat 4 status, NEW, ON REVIEW, REJECT, APPROVE. Hanya data NEW dan ON REVIEW saja yang bisa dilakukan edit
- Pada menu list data penawaran tim bisa mengubah/mapping data produk yang disubmit supplier jika data produk belum ada di master data, yang bertujuan agar  barang yang akan dilakukan perbandingan harga bisa selaras

### Handling Risiko Keamanan
- Pada portal suppplier ditambahkan captcha sebelum submit data penawaran yang bertujuan agar tidak terjadi spam submit data dengan data dummy yang bertujuan untuk menyerang server

## NOTES
db : db_kdi.sql
erd : erd.png
