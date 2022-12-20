import StudentController from "../controllers/StudentController.js"
import express from "express"

const router = express.Router()

router.get("/", (req, res) => {
  res.send("Tugas Praktikum 11 Muhammad Asnur Ramdani")
})

router.get("/students", StudentController.index)
router.post("/students", StudentController.store)
router.put("/students/:id", StudentController.update)
router.delete("/students/:id", StudentController.destroy)

export default router
