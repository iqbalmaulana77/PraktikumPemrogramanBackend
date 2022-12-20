/**
 * TODO 9:
 * - Import semua method FruitController
 * - Refactor variable ke ES6 Variable
 *
 * @hint - Gunakan Destructing Object
 */

const {
  index,
  store,
  update,
  destroy,
} = require("./Controller/FruitController")

/**
 * NOTES:
 * - Fungsi main tidak perlu diubah
 * - Jalankan program: nodejs app.js
*/

const main = () => {
  console.log("=== Fruit App ===")
  index()

  console.log("=== Store ===")
  store("semangka")
  index()

  console.log("=== Update ===")
  update(0, "pepaya")
  index()

  console.log("=== Destroy ===")
  destroy(1)
  index()
}

main()
