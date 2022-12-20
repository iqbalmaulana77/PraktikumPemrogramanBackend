/**
 * TODO:
 * - Refactor callback ke Promise atau Async Await
 * - Refactor function ke ES6 Arrow Function
 * - Refactor string ke ES6 Template Literals
 */

/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
const showDownload = (result) => {
  console.log("Download selesai")
  console.log(`Hasil Download: ${result}`)
}

/**
 * Fungsi untuk download file
 * @param {function} callback - Function callback show
 */
const download = (callback) => {
  // Simulasi proses download
  return new Promise((resolve, reject) => {
    let condition = true
    if (condition) {
      setTimeout(() => {
        const result = "windows-11.exe"
        resolve(callback(result))
      }, 3000)
    } else {
      reject("Download gagal")
    }
  })
}

download(showDownload)
  .then(result => console.log(result))
  .catch(error => console.log(error))
